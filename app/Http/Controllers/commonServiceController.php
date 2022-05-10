<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AvailableTimeslot;
use App\Models\MedicalStaff;
use App\Models\Patient;
use App\Models\Treatments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class commonServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:doctor');
    }

    public function index(){
        $allPatients = Patient::get();
        $allServices = Treatments::where('specialisation_id', '=', '6')->get();
        return view('staffDashboard.commonservices', ['allPatients' => $allPatients, 'allServices' => $allServices]);
    }

    public function getNursecs(Request $request){
        //Declare return value
        $nurses = "<option></option>";

        //query treatment 
        $treatment = Treatments::where('id', '=', $request->treatment)->first();
        //query medical staff related to the treatment specialisation
        if($treatment){            
            $getnurses = MedicalStaff::where('specialisation_id', '=', $treatment->specialisation_id)->get();
            foreach($getnurses as $n){
                $nurses .= "<option value='". $n->id . "'>" . $n->user->name . "</option>";
            }
        }

        return response()->json(['nurses'=>$nurses]);
    }

    public function getDatecs(Request $request){
        //Declare return value
        $returnDates = "<option></option>";

        //query medical staff
        $ms = MedicalStaff::where('id', '=', $request->nurse)->first();

        //List down the dates
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

        //Query nurse date available timeslot and remove the date if the timeslots is full booked
        foreach($dates as $key => $d){
            $tempDate = AvailableTimeslot::where([
                ['availDate', '=', $d],
                ['blockNumber', '=', '0'],
                ['medical_staff_id', '=', $ms->id]
            ])->orWhere([
                ['availDate', '=', $d],
                ['blockNumber', '=', '1'],
                ['medical_staff_id', '=', $ms->id]
            ])->orWhere([
                ['availDate', '=', $d],
                ['blockNumber', '=', '2'],
                ['medical_staff_id', '=', $ms->id]
            ])->orWhere([
                ['availDate', '=', $d],
                ['blockNumber', '=', '3'],
                ['medical_staff_id', '=', $ms->id]
            ])->orWhere([
                ['availDate', '=', $d],
                ['blockNumber', '=', '4'],
                ['medical_staff_id', '=', $ms->id]
            ])->orWhere([
                ['availDate', '=', $d],
                ['blockNumber', '=', '5'],
                ['medical_staff_id', '=', $ms->id]
            ])->get();
            if($tempDate->count() >= 6){
                unset($dates[$key]);
            }
        }

        //Construct the return dates 
        foreach($dates as $d){
            $returnDates .= "<option value='" . $d . "|" . $ms->id ."'>" . $d . "</option>";
        }

        //Return the dates
        return response()->json(['dates'=>$returnDates]);
    }

    public function getTimecs(Request $request){
        //Declare return value
        $returnTime = "<option></option>";

        //explode date and ms
        $dateNms = explode("|", $request->date);

        //return the timeslot if is available (check blockNumber 0-6)
        for($i=0; $i <= 5; $i++){
            $tempTime = AvailableTimeslot::where([
                ['availDate', '=', $dateNms[0]],
                ['blockNumber', '=', $i],
                ['medical_staff_id', '=', $dateNms[1]]
            ])->first();
            if(!$tempTime){
                $iTime = "";
                switch($i){
                    case "0":
                        $iTime .= "0900 HRS to 1000 HRS";
                        break;
                    case "1":
                        $iTime .= "1000 HRS to 1100 HRS";
                        break;
                    case "2":
                        $iTime .= "1100 HRS to 1200 HRS";
                        break;
                    case "3":
                        $iTime .= "1300 HRS to 1400 HRS";
                        break;
                    case "4":
                        $iTime .= "1400 HRS to 1500 HRS";
                        break;
                    case "5":
                        $iTime .= "1500 HRS to 1600 HRS";
                        break;
                }
                $returnTime .= "<option value='" . $i . "'>" . $iTime . "</option>";
            }
        }

        //return time
        return response()->json(['time'=>$returnTime]);
    }

    public function store(Request $request){
        $this->validate($request,[
            "date" => "required",
            "time" => "required",
            "services" => "required",
            "patient" => "required",
            "nurse" => "required",
        ]);

        //Explode date
        $dateNms = explode("|", $request->date);

        //Create the availableTimeslot to block off the time
        AvailableTimeslot::create([
            "medical_staff_id" => $request->nurse,
            "availDate" => $dateNms[0],
            "blockNumber" => $request->time,
            "status" => "1"
        ]);

        //Get department id
        $treatment = Treatments::where('id', '=', $request->services)->first();

        //Create appointment
        Appointment::create([
            "patient_id" => $request->patient,
            "medical_staff_id" => $request->nurse,
            "treatment_id" => $request->services,
            "department_id" => $treatment->department->id,
            "appDate" => $dateNms[0],
            "appTime" => $request->time,
            "status" => "awaiting"
        ]);

        Session::flash('succ', 'Successfully booked an appointment.');
        return redirect()->route('rolebased');
    }
}
