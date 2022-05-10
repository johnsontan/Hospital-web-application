<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentNotification;
use App\Models\Appointment;
use App\Models\AvailableTimeslot;
use App\Models\Department;
use App\Models\MedicalStaff;
use App\Models\Patient;
use App\Models\Specialisation;
use App\Models\Specialsation;
use App\Models\Treatments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function sendNotification($date, $time, $treatment, $ms){
        Mail::to(Auth::user()->email)->send(new AppointmentNotification($date, $time, $treatment, $ms));
    }

    public function index(){
        $specialisation = Specialisation::where('id', '!=', '6')->get();     
        return view('appointment.createapp', ["specialisation" => $specialisation]);
    }

    public function aindex(){
        $specialisation = Specialisation::where('id', '!=', '6')->get();   
        $patients = Patient::get();      
        return view('appointment.acreateapp', ["specialisation" => $specialisation, "patients" => $patients]);
    }

    public function destory(Appointment $appointment){

        //changed status to 0 [available] 
        $iATS = AvailableTimeslot::where([
            ['medical_staff_id', '=', $appointment->medical_staff_id],
            ['availDate', '=', $appointment->appDate],
            ['blockNumber', '=', $appointment->appTime],
            ['status', '=', '1']
        ])->first();

        $iATS->update([
            "status" => "0",
        ]);
        
        //Delete appointment
        $appointment->delete();

        if(Auth::user()->hasRole('staff')){
            return redirect()->route('staffApp.view', ["ms" => Auth::user()->medicalStaff->id]);
        }
        elseif(Auth::user()->hasRole('admin')){
            return redirect()->route('adminApp.view');
        }
        else{
            return redirect()->route('bookApp.view', ["user" => Auth::user()->id]);
        }
    }

    public function treatment(Request $request){
        $sp = Specialisation::where('id', '=', $request->specialisation)->first();
        $doctors = "";
        $doctors .= '<option value=""> </option>';   
        foreach($sp->medicalStaff as $m){
            $doctors .= '<option value="'.$m->id.'"> Dr '.$m->user->name.'</option>';            
        }
        return response()->json(['doctors'=>$doctors]);
    }

    public function medicalstaff(Request $request){
        $ms = MedicalStaff::where('id', '=', $request->ms)->first();
        $availTimeslots = $ms->availableTimeslot()->select('medical_staff_id', 'availDate', 'status')->distinct()->get();
        $ats = "";
        $ats .= '<option value=""> </option>';
        foreach($availTimeslots as $m){
            if($m->status == "0"){
                $ats .= '<option value="'.$m->medical_staff_id.'|'.$m->availDate.'">'.$m->availDate.'</option>'; 
            }
        }
        if($ms->specialisation->specialisation == "Nursing"){
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
                $ats .= "<option value='" . $ms->id . "|" . $d ."'>" . $d . "</option>";
            }
        }
        return response()->json(['ats'=>$ats]);
    }

    public function date(Request $request){
        $timeslots = AvailableTimeslot::where([['medical_staff_id', '=', $request->ms],['availDate', '=', $request->date],['status', '=', '0']])->get();
        $blockNum = "";
        $blockNum .= '<option value=""> </option>';
        foreach($timeslots as $time){
            switch($time->blockNumber){
                case "0":
                    $blockNum .= '<option value="0|0900">0900HRS - 1000HRS</option>'; 
                    break;
                case "1":
                    $blockNum .= '<option value="1|1000">1000HRS - 1100HRS</option>';
                    break;
                case "2":
                    $blockNum .= '<option value="2|1100">1100HRS - 1200HRS</option>';
                    break;
                case "3":
                    $blockNum .= '<option value="3|1300">1300HRS - 1400HRS</option>';
                    break;
                case "4":
                    $blockNum .= '<option value="4|1400">1400HRS - 1500HRS</option>';
                    break;
                case "5":
                    $blockNum .= '<option value="5|1500">1500HRS - 1600HRS</option>';
                    break;
            }
        }

        //Nursing get medical staff
        $ms = MedicalStaff::where('id', '=', $request->ms)->first();
        if($ms->specialisation->specialisation == "Nursing"){
            //return the timeslot if is available (check blockNumber 0-6)
            for($i=0; $i <= 5; $i++){
                $tempTime = AvailableTimeslot::where([
                    ['availDate', '=', $request->date],
                    ['blockNumber', '=', $i],
                    ['medical_staff_id', '=', $request->ms]
                ])->first();
                if(!$tempTime){
                    $iTime = "";
                    switch($i){
                        case "0":
                            $iTime .= "0900HRS - 10000HRS";
                            $blockNum .= "<option value='" . $i . "|0900'>" . $iTime . "</option>";
                            break;
                        case "1":
                            $iTime .= "1000HRS - 11000HRS";
                            $blockNum .= "<option value='" . $i . "|1000'>" . $iTime . "</option>";
                            break;
                        case "2":
                            $iTime .= "1100HRS - 12000HRS";
                            $blockNum .= "<option value='" . $i . "|1100'>" . $iTime . "</option>";
                            break;
                        case "3":
                            $iTime .= "1300HRS - 14000HRS";
                            $blockNum .= "<option value='" . $i . "|1300'>" . $iTime . "</option>";
                            break;
                        case "4":
                            $iTime .= "1400HRS - 15000HRS";
                            $blockNum .= "<option value='" . $i . "|1400'>" . $iTime . "</option>";
                            break;
                        case "5":
                            $iTime .= "1500 HRS to 16000 HRS";
                            $blockNum .= "<option value='" . $i . "|1500'>" . $iTime . "</option>";
                            break;
                    }                    
                }
            }
        }
        return response()->json(['blockNum'=>$blockNum]);
    }

    public function store(Request $request){
        $this->validate($request, [
            "specialisation_id" => "required",
            "medicalStaff" => "required",
            "date" => "required",
            "time" => "required",
        ]);
        
        //Get department, blockNum, date, ms, time, email time, treatment
        $treatment = Treatments::where([
            ['specialisation_id', '=', $request->specialisation_id],
            ['treatmentTitle', 'like', '%Consultation%']        
        ])->first();

        $department = $treatment->department()->first();
        $msDate = explode("|", $request->date); //Medical staff n Date array
        $date = $msDate[1];
        $timeArray = explode("|", $request->time);
        $time = $timeArray[0];
        $ms = MedicalStaff::where('id', '=', $request->medicalStaff)->first();
        $emailTime = "";
        switch($time){
            case "0":
                $emailTime .= "0900 HRS to 10000 HRS";
                break;
            case "1":
                $emailTime .= "1000 HRS to 11000 HRS";
                break;
            case "2":
                $emailTime .= "1100 HRS to 12000 HRS";
                break;
            case "3":
                $emailTime .= "1300 HRS to 14000 HRS";
                break;
            case "4":
                $emailTime .= "1400 HRS to 15000 HRS";
                break;
            case "5":
                $emailTime .= "1500 HRS to 16000 HRS";
                break;
        }

        //Create appointments
        $patientUser = Auth::user()->patient()->first();
        $patientUser->appointments()->create([
            "medical_staff_id" => $request->medicalStaff,
            "treatment_id" => $treatment->id,
            "department_id" => $department->id,
            "appDate" => $date,
            "appTime" => $time,
            "status" => "awaiting",
        ]);


        //Delete available timeslot from the medical staff
        $ts = AvailableTimeslot::where([
                ['medical_staff_id', '=', $request->medicalStaff],
                ['availDate', '=', $date],
                
        ])->get();
        foreach($ts as $t){
            if((strcmp($t->blockNumber, $time)) == '0'){
                $t->update([
                    "status" => "1",
                ]);
                $this->sendNotification($date, $emailTime, $treatment->treatmentTitle, $ms->user->name);
                Session::flash("succ", "Appointment booked. A reminder has been sent to your email address as a reference.");
                return redirect()->route('rolebased');
            }
        }
                       
        return redirect()->route('rolebased');
    }

    public function astore(Request $request){
        $this->validate($request, [
            "patient" => "required",
            "specialisation_id" => "required",
            "medicalStaff" => "required",
            "date" => "required",
            "time" => "required",
        ]);
        
        //Get department, blockNum, date, ms
        $treatment = Treatments::where([
            ['specialisation_id', '=', $request->specialisation_id],
            ['treatmentTitle', 'like', '%consultation%']        
        ])->first();
        $department = $treatment->department()->first();
        $msDate = explode("|", $request->date); //Medical staff n Date array
        $date = $msDate[1];
        $timeArray = explode("|", $request->time);
        $time = $timeArray[0];
        $ms = MedicalStaff::where('id', '=', $request->medicalStaff)->first();
        $emailTime = "";
        switch($time){
            case "0":
                $emailTime .= "0900 HRS to 10000 HRS";
                break;
            case "1":
                $emailTime .= "1000 HRS to 11000 HRS";
                break;
            case "2":
                $emailTime .= "1100 HRS to 12000 HRS";
                break;
            case "3":
                $emailTime .= "1300 HRS to 14000 HRS";
                break;
            case "4":
                $emailTime .= "1400 HRS to 15000 HRS";
                break;
            case "5":
                $emailTime .= "1500 HRS to 16000 HRS";
                break;
        }
        
        //Create appointments
        $patientUser = Patient::where('id', '=', $request->patient)->first();
        $patientUser->appointments()->create([
            "medical_staff_id" => $request->medicalStaff,
            "treatment_id" => $treatment->id,
            "department_id" => $department->id,
            "appDate" => $date,
            "appTime" => $time,
            "status" => "awaiting",
        ]);


        //Delete available timeslot from the medical staff
        $ts = AvailableTimeslot::where([
                ['medical_staff_id', '=', $request->medicalStaff],
                ['availDate', '=', $date],
                
        ])->get();
        foreach($ts as $t){
            if((strcmp($t->blockNumber, $time)) == '0'){
                $t->update([
                    "status" => "1",
                ]);
                $this->sendNotification($date, $emailTime, $treatment->treatmentTitle, $ms->user->name);
                Session::flash('succ', 'Appointment booked.');
                return redirect()->route('rolebased');
            }
        }
        
        return redirect()->route('rolebased');
    }

    public function view(User $user){
        //Define today date
        $tdyDate = date('Y-m-d');

         //Check for any missed appointments, and change its status from awaiting to lapse
         $missedApp = Appointment::where([
            ['appDate', '<', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'awaiting']
        ])->get();

        foreach($missedApp as $app)
        {
            $app->update([
                "status" => "lapse",
            ]);
        }
        
        $lapseApp = Appointment::where([
            ['appDate', '<=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'lapse']
        ])->get();


        
        //Get upcoming and past appointment records
        $upcomingApp = Appointment::where([
            ['appDate', '>=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'awaiting']
        ])->get();

        
        $pastApp = Appointment::where([
            ['appDate', '<=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'consulted']
        ])->orWhere([
            ['appDate', '<=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'completed']
        ])->orWhere([
            ['appDate', '<=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'paymentPending']
        ])->orWhere([
            ['appDate', '<=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'referral accepted']
        ])
        ->orWhere([
            ['appDate', '<=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'referred']
        ])
        ->orWhere([
            ['appDate', '<=', $tdyDate],
            ['patient_id', '=', $user->patient->id],
            ['status', '=', 'lapse']
        ])->get();


        return view('appointment.viewapp', ["upcomingApp"=>$upcomingApp, "pastApp"=>$pastApp, "lapseApp"=>$lapseApp]);
    }

    public function edit(Appointment $appointment){
        $sp = $appointment->treatment->specialisation()->first();
        $treatment = $appointment->treatment()->first();
        $ms = $sp->medicalStaff()->get();
       
        return view('appointment.editapp', ["doctors" => $ms, "treatment" => $treatment, "app" => $appointment]);
    }

    public function update(Request $request, Appointment $appointment){
        //validation
        $this->validate($request,[
            "treatment_id" => "required",
            "medicalStaff" => "required",
            "date" => "required",
            "time" => "required",
        ]);
        
        //Get department, date, block number, get medical staff
        $treatment = Treatments::where('id', '=', $request->treatment_id)->first();
        $sp = $treatment->specialisation()->first();
        $department = $sp->department()->first();
        $msDate = explode("|", $request->date);
        $date = $msDate[1];
        $blocktime = explode("|", $request->time);
        $time = $blocktime[0];
        $emailTime = "";
        $docOrNurse = MedicalStaff::where('id', '=', $request->medicalStaff)->first();
        
        switch($time){
            case "0":
                $emailTime .= "0900 HRS to 10000 HRS";
                break;
            case "1":
                $emailTime .= "1000 HRS to 11000 HRS";
                break;
            case "2":
                $emailTime .= "1100 HRS to 12000 HRS";
                break;
            case "3":
                $emailTime .= "1300 HRS to 14000 HRS";
                break;
            case "4":
                $emailTime .= "1400 HRS to 15000 HRS";
                break;
            case "5":
                $emailTime .= "1500 HRS to 16000 HRS";
                break;
        }
                
        if($docOrNurse->user->hasRole('doctor')){
            //Patch available timeslot
            //change status to 1 [booked]
            $dATS = AvailableTimeslot::where([
                ['medical_staff_id', '=', $request->medicalStaff],
                ['availDate', '=', $date],
                ['blockNumber', '=', $time],
            ])->first();
            $dATS->update([
                "status" => "1",
            ]);

            //changed status to 0 [available] 
            $iATS = AvailableTimeslot::where([
                ['medical_staff_id', '=', $appointment->medical_staff_id],
                ['availDate', '=', $appointment->appDate],
                ['blockNumber', '=', $appointment->appTime],
                ['status', '=', '1']
            ])->first();
            $iATS->update([
                "status" => "0",
            ]);
        }
        elseif($docOrNurse->user->hasRole('nurse')){
            AvailableTimeslot::create([
                "medical_staff_id" => $request->medicalStaff,
                "availDate" => $date,
                "blockNumber" => $time,
                "status" => "1"
            ]);

            $deleteTimeslot = AvailableTimeslot::where([
                ['medical_staff_id', '=', $appointment->medical_staff_id],
                ['availDate', '=', $appointment->appDate],
                ['blockNumber', '=', $appointment->appTime],
                ['status', '=', '1']
            ])->first();

            $deleteTimeslot->delete();
        }

        //Patch appointment record
        $appointment->update([
            "medical_staff_id" => $request->medicalStaff,
            "department_id" => $department->id,
            "appDate" => $date,
            "appTime" => $time,
            "status" => "awaiting",
        ]);

        $this->sendNotification($date, $emailTime, $appointment->treatment->treatmentTitle, $appointment->medicalStaff->user->name);

        if(Auth::user()->hasRole('staff')){
            Session::flash('succ', 'Appointment updated.');
            return redirect()->route('staffApp.view', ["ms" => Auth::user()->medicalStaff->id]);
        }
        elseif(Auth::user()->hasRole('admin')){
            Session::flash('succ', 'Appointment updated.');
            return redirect()->route('adminApp.view');
        }
        else{
            Session::flash('succ', 'Appointment updated.');
            return redirect()->route('bookApp.view', ["user" => Auth::user()->id]);
        }

    }

    public function sview(MedicalStaff $ms){
        //Define today date
        $tdyDate = date('Y-m-d');
        $upcomingApp = Appointment::where([
            ['appDate', '>=', $tdyDate],
            ['medical_staff_id', '=', $ms->id],
            ['status', '=', 'awaiting'],
        ])->get();

        $pastApp = Appointment::where([
            ['appDate', '<=', $tdyDate],
            ['medical_staff_id', '=', $ms->id],
            ['status', '!=', 'awaiting']
        ])->get();

        return view('appointment.staffviewapp', ["upcomingApp"=>$upcomingApp, "pastApp"=>$pastApp]);
    }

    public function sedit(Appointment $appointment){
        $sp = $appointment->treatment->specialisation()->first();
        $treatment = $appointment->treatment()->first();
        $ms = MedicalStaff::where([
            ["id", '=', Auth::user()->medicalStaff->id],
            ['specialisation_id', '=', $sp->id]
        ])->first();

        return view('appointment.seditapp', ["doctor" => $ms, "treatment" => $treatment, "app" => $appointment]);
    }

    public function aview(){
        //Define today date
        $tdyDate = date('Y-m-d');
        $upcomingApp = Appointment::where([
            ['appDate', '>=', $tdyDate],
            ['status', '=', 'awaiting']
        ])->get();
        
        $pastApp = Appointment::where([
            ['appDate', '<=', $tdyDate],
            ['status', '!=', 'awaiting']
        ])->get();

        return view('appointment.adminviewapp', ["upcomingApp"=>$upcomingApp, "pastApp"=>$pastApp]);
    }

    
  
}
