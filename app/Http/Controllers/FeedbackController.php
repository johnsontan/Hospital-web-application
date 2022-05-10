<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Feedback;
use App\Models\Treatments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:patient|admin');
    }

    public function create(Appointment $app){
        if($app->feedback()->get()->isEmpty()){
            return view('feedback.createFeedback', ['app' => $app]);
        }
        else{
            return redirect()->back();
        }
    }

    public function store(Request $request){
        //Validate
        $this->validate($request, [
            "comment" => 'required',
            'rating' => 'required',
            'appID' => 'required'
        ]);
        
        //Get appointment 
        $app = Appointment::where('id', '=', $request->appID)->first();

        //store feedback
        $app->feedback()->create([
            'comment' => $request->comment,
            'patient_id' => $app->patient->id,
            'rating' => $request->rating,
        ]);
       
        return redirect()->route('bookApp.view', ['user' => $app->patient->user->id]);
    }

    public function aview(){        
        
        $allFeedback = Feedback::paginate(5);
        $allTreatments = Treatments::all();
      
        return view('feedback.aviewFeedback', ['allFeedback' => $allFeedback, 'allTreatments'=>$allTreatments]);
    }

    public function searchTreatment(Request $request)
    {
        //validation
        $rules = [
            "tags"    => "required|array",
            'tags.*' => 'required',
 
            ];
            
            $this->validate($request,$rules);
            $tags = $request->tags;
            $allTreatments = Treatments::all();
            
    
        $result = Treatments::join('appointments','treatments.id','=','appointments.treatment_id')
        ->join('feedback','appointments.id','=','feedback.appointment_id')
        ->join('patients','feedback.patient_id','=','patients.id')
        ->join('users','patients.user_id','=','users.id')
        ->select('feedback.id','users.name','feedback.comment','feedback.rating','treatments.treatmentTitle')
        ->whereIn('treatments.id',$tags)->distinct()->paginate(5);
   
      
        //Calculate Average Rating 
        $averageRating = Treatments::join('appointments','treatments.id','=','appointments.treatment_id')
        ->join('feedback','appointments.id','=','feedback.appointment_id')
        ->join('patients','feedback.patient_id','=','patients.id')
        ->join('users','patients.user_id','=','users.id')
        ->select('treatments.treatmentTitle',DB::raw('AVG( feedback.rating ) as averageRating'))
        ->whereIn('treatments.id',$tags)
        ->groupBy('treatments.id')
        ->get();
             
        Session::put('averageRating', $averageRating);

        //Total feedback per treatment
        $feedbackCount = Treatments::join('appointments','treatments.id','=','appointments.treatment_id')
        ->join('feedback','appointments.id','=','feedback.appointment_id')
        ->join('patients','feedback.patient_id','=','patients.id')
        ->join('users','patients.user_id','=','users.id')
        ->select('treatments.treatmentTitle',DB::raw('COUNT( * ) as feedbackCount'))
        ->whereIn('treatments.id',$tags)
        ->groupBy('treatments.id')
        ->get();

        Session::put('feedbackCount', $feedbackCount);
           
        if (count ( $result ) > 0)
        {
            return redirect()->route('feedback.aview')->with(['searchResults'=>$result,'allTreatments'=>$allTreatments]); 
        }
       
        else
        return redirect()->route('feedback.aview')->with(['message'=>'No results found','allTreatments'=>$allTreatments]);
	
            
          
           
    }
    public function showChart()
    {  
        return view ('feedback.aviewFeedbackChart');
    }

    public function aviewComment($id)
    {
        //Get one record of the feedback which matches the id 
        $feedback= Feedback::whereid($id)->first();
        return view('feedback.aviewFeedbackComment',['feedback'=>$feedback]);
    }
}
