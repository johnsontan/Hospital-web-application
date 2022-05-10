<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolebasedController;
use App\Http\Controllers\roles\PatientController;
use App\Models\User;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class ConditionController extends Controller
{
        //
        public function __construct()
        {
            $this->middleware('auth');
        }
        
        public function index(Request $request)
        {
            DB::table('tagging_tags')->where('count','0')->delete();

            if(Auth::user() && $request->user()->hasRole('admin'))
            {
                $condition = Condition::paginate(5);
                $tags = Condition::existingTags();
                return view('healthConditions.adminHealthConditions',[
                'condition'=>$condition,'tags'=>$tags
            ]);
            }

            else if (Auth::user() && $request->user()->hasRole('patient'))
            {
                $condition = Condition::paginate(5);
                $tags = Condition::existingTags();
                return view('healthConditions.searchHealthConditions',[
                'condition'=>$condition,'tags'=>$tags
                ]);

            }
        
        }

        public function searchResult(Request $request)
        {

            //validation (One of the field must be filled)
            $rules = [
            'searchVariable' => 'required_without_all:tags',
            'tags' => 'required_without_all:searchVariable',
            ];
        
            $this->validate($request,$rules);

            $x = $request->searchVariable;
            $tags = $request->tags;
            //Current existing tags for all the conditions to return back to the search page
            $tags = Condition::existingTags();
           
           
            //If tags is not set, just search text field will do
            if (!isset($request->tags))
            {
                $result = Condition::where('title', 'LIKE', '%'.$x.'%')->distinct()->paginate(5);
            }
           else
            {
                 $result = Condition::where('title', 'LIKE', '%'.$x.'%')->withAllTags($request->tags)->distinct()->paginate(5);
                      
            }
           
                    
            if (count ($result)>0)
            {
                return redirect()->route('searchCondition')->with(['searchResults'=>$result,'tags'=>$tags,]);
            }
            else
            {
                return redirect()->route('searchCondition')->with(['errorMsg'=>'No result found.','tags'=>$tags,]);
            }

        }

        //submit form
        public function add(Request $request)
        {
            DB::table('tagging_tags')->where('count','0')->delete();
            $this->validate($request,[
               'title' => 'required',
               'conditionDesc' => 'required',
               'conditionTreatment' =>'required',
               'exampleCheck1' =>'accepted',
               'tags' => 'required',
           ]);
    
           $post = Condition::create([ 
               'title' => $request->title,
               'conditionDesc' => $request->conditionDesc,  
               'conditionTreatment' => $request->conditionTreatment,  
               
            ]);

            
            $tags = explode(",", $request->tags);
            $post->tag($tags);

            //Redirect to the same page
            Session::flash('succ', 'Health condition has been added successfully.');
            return redirect()->back();
           
        }

        //Redirect to the edit page for the specific condition
        public function edit(Condition $condition){
            $condition = Condition::where('id', '=', $condition->id)->first();

           
            return view('healthConditions.editHealthConditions', [
                'condition'=>$condition,
            ]);

        }

        //update to db
        public function update(Request $request, Condition $condition)
        {
            $this->validate($request,[
                'title' => 'required',
                'conditionDesc' => 'required',
                'conditionTreatment' =>'required',
                'exampleCheck1' =>'accepted',
                'tags' => 'required',
            ]);

            $condition->update([ 
               'title' => $request->title,
               'conditionTreatment' => $request->conditionTreatment,
               'conditionDesc' => $request->conditionDesc,
            ]);

            $condition->retag($request->tags);
            DB::table('tagging_tags')->where('count','0')->delete();

            //Redirect to the same page
            Session::flash('succ', 'Condition has been updated successfully');
            return redirect()->back();
            
        
    
        }

        //delete data
        public function delete(Condition $condition)
        {
            $condition->untag();
            $condition->delete();
            $condition = Condition::where('id','=', $condition->id)->first();
            DB::table('tagging_tags')->where('count','0')->delete();
            Session::flash('succ', 'Condition has been deleted successfully');
            return redirect()->back();
        }

        //see more
        public function view(Condition $condition)
        {
            $condition = Condition::where('id', '=', $condition->id)->first();

            return view('healthConditions.viewHealthConditions', [
                'condition'=>$condition,
            ]);
        }

       

        
}