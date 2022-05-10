<?php

namespace App\Http\Controllers;

use App\Models\AvailableTimeslot;
use App\Models\MedicalStaff;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableTimeslotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor|admin');
    }

    public function index(){
        $dates = array(
            date('Y-m-d', strtotime('+1 days')), 
            date('Y-m-d', strtotime('+2 days')), 
            date('Y-m-d', strtotime('+3 days')),
            date('Y-m-d', strtotime('+4 days')),
            date('Y-m-d', strtotime('+5 days')),
            date('Y-m-d', strtotime('+6 days')),
            date('Y-m-d', strtotime('+7 days')),
            date('Y-m-d', strtotime('+8 days')), 
            date('Y-m-d', strtotime('+9 days')), 
            date('Y-m-d', strtotime('+10 days')),
            date('Y-m-d', strtotime('+11 days')),
            date('Y-m-d', strtotime('+12 days')),
            date('Y-m-d', strtotime('+13 days')),
            date('Y-m-d', strtotime('+14 days')),
        );
        //Get the dates
        $from = $dates[0];
        $to = $dates[13];

        //Get all the records between the dates with status 0
        $records = AvailableTimeslot::whereBetween('availDate', [$from, $to])->where([
            ['medical_staff_id', Auth::user()->medicalStaff->id],
            ['status', '=', '0']
        ])->get();

        //Get all the records between the dates | Used to populate the timeNdate selections
        $selectRecords = AvailableTimeslot::whereBetween('availDate', [$from, $to])->where([
            ['medical_staff_id', Auth::user()->medicalStaff->id],
        ])->get();


        //Delete all the records whereNotBetween from, to
        AvailableTimeslot::whereNotBetween('availDate', [$from, $to])->where("status", "=", "0")->delete();


        return view('availableTimeslot.viewavailtimeslot', ["dates" => $dates, "records" => $records, "selectRecords" => $selectRecords]);
    }

    public function store(Request $request){
        $this->validate($request,[
            "setTimeslot" => 'required',
        ]);

        //Remove all the dates
        foreach($request->setTimeslot as $eaTimeslot){
            //date
            $date = substr($eaTimeslot, 0, 10);

            //time
            $blockNum = substr($eaTimeslot, 15);

            //Deleting all the related dates
            AvailableTimeslot::where([
                ['medical_staff_id','=', Auth::user()->medicalStaff->id],
                ['availDate', '=', $date],
                ['status', '=', '0']
            ])->delete();
        }

        //insert all the dates
        foreach($request->setTimeslot as $eaTimeslot){
            //date
            $date = substr($eaTimeslot, 0, 10);

            //time
            $blockNum = substr($eaTimeslot, 15);

            //Inserting the dates again
            $user = Auth::user();
            $user->medicalStaff->availableTimeslot()->create([
                "availDate" => $date,
                "blockNumber" => $blockNum,
                "status" => "0",
            ]);

            
        }
        return redirect()->route('availtimeslot.index');
    }

    public function destory(AvailableTimeslot $at){
        $ms = MedicalStaff::where('id', '=', $at->medical_staff_id)->first();
        $at->delete();
        if(Auth::user()->hasRole('admin')){
            return redirect()->route('availtimeslot.aindex', ["ms" => $ms->id]);
        }else{
            return redirect()->route('availtimeslot.index');
        }

    }

    public function viewall(){

        $ms = MedicalStaff::whereNotNull('id')->distinct()->paginate(10);;

        return view('availableTimeslot.viewAllStaffAT', ['ms' => $ms]);
    }

    public function aindex(MedicalStaff $ms){
        $dates = array(
            date('Y-m-d', strtotime('+1 days')), 
            date('Y-m-d', strtotime('+2 days')), 
            date('Y-m-d', strtotime('+3 days')),
            date('Y-m-d', strtotime('+4 days')),
            date('Y-m-d', strtotime('+5 days')),
            date('Y-m-d', strtotime('+6 days')),
            date('Y-m-d', strtotime('+7 days')),
            date('Y-m-d', strtotime('+8 days')), 
            date('Y-m-d', strtotime('+9 days')), 
            date('Y-m-d', strtotime('+10 days')),
            date('Y-m-d', strtotime('+11 days')),
            date('Y-m-d', strtotime('+12 days')),
            date('Y-m-d', strtotime('+13 days')),
            date('Y-m-d', strtotime('+14 days')),
        );
        //Get the dates
        $from = $dates[0];
        $to = $dates[13];

        //Get all the records between the dates
        $records = AvailableTimeslot::whereBetween('availDate', [$from, $to])->where('medical_staff_id', $ms->id)->get();

        //Get all records between the dates with status 0
        $selectRecords = AvailableTimeslot::whereBetween('availDate', [$from, $to])->where([['medical_staff_id', $ms->id], ['status', '=', '0']])->get();

        //Delete all the records whereNotBetween from, to
        AvailableTimeslot::whereNotBetween('availDate', [$from, $to])->where("status", "=", "0")->delete();


        return view('availableTimeslot.aviewavailtimeslot', ["dates" => $dates, "records" => $records, "ms" => $ms, "selectRecords" => $selectRecords]);
    }

    public function astore(Request $request, MedicalStaff $ms){
        $this->validate($request,[
            "setTimeslot" => 'required'
        ]);
        
        //Remove all the dates
        foreach($request->setTimeslot as $eaTimeslot){
            //date
            $date = substr($eaTimeslot, 0, 10);

            //time
            $blockNum = substr($eaTimeslot, 15);

            //Deleting all the related dates
            AvailableTimeslot::where([
                ['medical_staff_id','=', $ms->id],
                ['availDate', '=', $date],
                ['status', '=', '0']
            ])->delete();
        }

        //insert all the dates
        foreach($request->setTimeslot as $eaTimeslot){
            //date
            $date = substr($eaTimeslot, 0, 10);

            //time
            $blockNum = substr($eaTimeslot, 15);

            //Inserting the dates again
            $ms->availableTimeslot()->create([
                "availDate" => $date,
                "blockNumber" => $blockNum,
                "status" => "0",
            ]);

            
        }
        return redirect()->route('availtimeslot.aindex', ["ms" => $ms->id]);
    }
    
}
