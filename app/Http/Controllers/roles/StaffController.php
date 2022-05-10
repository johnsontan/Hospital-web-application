<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentNotification;
use App\Models\Appointment;
use App\Models\AvailableTimeslot;
use App\Models\EMedicalCert;
use App\Models\HealthRecord;
use App\Models\MedicalStaff;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\Treatments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:staff');
    }

    private function sendNotification($date, $time, $treatment, $ms){
        Mail::to(Auth::user()->email)->send(new AppointmentNotification($date, $time, $treatment, $ms));
    }

    public function consult(){
        //Get auth user and appointment (today date)
        $user = Auth::user();
        $todayDate = date('Y-m-d');
        $appointments = Appointment::where([
            ['medical_staff_id', '=', $user->medicalStaff->id],
            ['appDate', '=', $todayDate],
            ['status', '=', 'awaiting']
        ])->get();

        //Get types of treatment based on the specialisation 
        $treamtents = Treatments::where([
            ['specialisation_id', '=', $user->medicalStaff->specialisation->id],
            ['treatmentTitle', 'not like', '%consultation%']
        ])->get();

        //Get all types of medications 
        $medications = Medication::get();

        return view('staffDashBoard.consultPatient', ['appointments' => $appointments, 'treamtents' => $treamtents, 'medications' => $medications]);
    }

    public function getAppRec(Request $request){
        //Get appointment rec
        $app = Appointment::where('id', '=', $request->appID)->first();

        if($app ===  null){
            $appRec = "<tr><td>No info</td><td>No info</td><td>No info</td><td>No info</td><td>No info</td><td>No info</td></tr>";
            $patientHistory = "<tr><td>No Info</td><td>No Info</td><td>No Info</td><td>No Info</td><td>No Info</td></tr>";
            return response()->json(['appRec'=>$appRec, 'patientHistory' => $patientHistory]);
        }else{
            //convert timeblock to time
            $time = "NIL";
            switch($app->appTime){
                case "0":
                    $time = "0900HRS - 1000HRS";
                    break;
                case "1":
                    $time = "1000HRS - 1100HRS";
                    break;
                case "2":
                    $time = "1100HRS - 1200HRS";
                    break;
                case "3":
                    $time = "1300HRS - 1400HRS";
                    break;
                case "4":
                    $time = "1400HRS - 1500HRS";
                    break;
                case "5":
                    $time = "1500HRS - 1600HRS";
                    break;
            }

            //Construct html response with appointment memo
            $appRec = "<tr><td>". $app->patient->user->name . "</td><td>" . $app->treatment->treatmentTitle . "</td><td>" . $app->department->departmentName . "</td><td>" . $app->appDate . "</td><td>" . $time . "</td><td>" . $app->status . "</td></tr>";

            //Construct recurring appointment 
            $msTS = "<option value=''> </option>";
            if(Auth::user()->hasRole('doctor')){
                $msTimeslots = AvailableTimeslot::where([
                    ['medical_staff_id', '=', $app->medicalStaff->id],
                    ['status', '=', '0']                
                ])->get();
                foreach($msTimeslots as $ts){
                    $getTime = "";
                    switch($ts->blockNumber){
                        case "0":
                            $getTime = "0900HRS - 1000HRS";
                            break;
                        case "1":
                            $getTime = "1000HRS - 1100HRS";
                            break;
                        case "2":
                            $getTime = "1100HRS - 1200HRS";
                            break;
                        case "3":
                            $getTime = "1300HRS - 1400HRS";
                            break;
                        case "4":
                            $getTime = "1400HRS - 1500HRS";
                            break;
                        case "5":
                            $getTime = "1500HRS - 1600HRS";
                            break;
                    }
                    $msTS .= "<option value='". $app->id . "|" . $ts->id . "'>" . $ts->availDate . " | " . $getTime . "</option>";
                }
            }
            elseif(Auth::user()->hasRole('nurse')){
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
                
                //run through all the dates
                foreach($dates as $d){
                    for($i=0; $i<=5; $i++){
                        $tempTimeslot = AvailableTimeslot::where([
                            ['availDate', '=', $d],
                            ['medical_staff_id', '=', $app->medical_staff_id],
                            ['blockNumber', '=', $i]
                        ])->first();
                        if(!$tempTimeslot){
                            $getTime = "";
                            switch($i){
                                case "0":
                                    $getTime = "0900HRS - 1000HRS";
                                    break;
                                case "1":
                                    $getTime = "1000HRS - 1100HRS";
                                    break;
                                case "2":
                                    $getTime = "1100HRS - 1200HRS";
                                    break;
                                case "3":
                                    $getTime = "1300HRS - 1400HRS";
                                    break;
                                case "4":
                                    $getTime = "1400HRS - 1500HRS";
                                    break;
                                case "5":
                                    $getTime = "1500HRS - 1600HRS";
                                    break;
                            }
                            $msTS .= "<option value='". $app->id . "|" . $d . "|" . $i . "'>" . $d . " | " . $getTime . "</option>";
                        }
                    }
                }
            }

            //Construct patient history
            $patientHistory = "";
            $patientHistorym = "";          
            $ph = Appointment::where([
                ['patient_id', '=', $app->patient_id],
                ['status', '=', 'consulted']
            ])->orWhere([
                ['patient_id', '=', $app->patient_id],
                ['status', '=', 'completed']
            ])->orWhere([
                ['patient_id', '=', $app->patient_id],
                ['status', '=', 'referred']
            ])->orWhere([
                ['patient_id', '=', $app->patient_id],
                ['status', '=', 'referral accepted']
            ])->get(); 
            
            if(!$ph->isEmpty()){
                foreach($ph as $eachPH){
                    $phTime = "";
                    switch($eachPH->appTime){
                        case "0":
                            $phTime = "0900HRS - 1000HRS";
                            break;
                        case "1":
                            $phTime = "1000HRS - 1100HRS";
                            break;
                        case "2":
                            $phTime = "1100HRS - 1200HRS";
                            break;
                        case "3":
                            $phTime = "1300HRS - 1400HRS";
                            break;
                        case "4":
                            $phTime = "1400HRS - 1500HRS";
                            break;
                        case "5":
                            $phTime = "1500HRS - 1600HRS";
                            break;
                    }
                    $patientHistory .= "<tr><td>" . $eachPH->treatment->treatmentTitle . "</td><td>" . $eachPH->department->departmentName . "</td><td>" . $eachPH->appDate . "</td><td>" . $phTime . "</td><td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#ph" . $eachPH->id ."'>View memo</button></td></tr>";

                    $patientHistorym .= "<div class='modal fade' id='ph" . $eachPH->id ."' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel" . $eachPH->id ."' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><h5 class='modal-title' id='staticBackdropLabel". $eachPH->id ."'>Memo</h5><button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></div><div class='modal-body'>" . $eachPH->memo . "</div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button></div></div></div></div>";
                }  
            }          

            return response()->json(['appRec'=>$appRec, 'appMemo' => $app->memo, 'msTS' => $msTS, 'patientHistory' => $patientHistory, 'patientHistorym' => $patientHistorym]);
        }
        
    }

    public function updateStatus(Request $request){
        //Validation
        $this->validate($request,[
            "appointment" => "required",
            "memo" => '',
            "medication_name[]" => '',
            "medication_quantity[]" => '',
            "duration" => '',
            "remarks" => '',

        ]);

        //Update appointment record, required treatment?
        $app = Appointment::findOrFail($request->appointment);
        if(!is_null($request->treatment)){
            $app->update([
                "status" => "consulted",
                "memo" => $request->memo,
                "treatment_id" => $request->treatment,
            ]);
        }else{
            $app->update([
                "status" => "consulted",
                "memo" => $request->memo,
            ]);
        }

        //Recurring appointment if bookApp NOT NULL
        if(!is_null($request->bookApp)){
            
            if(Auth::user()->hasRole('doctor')){
                $appNtime = explode("|", $request->bookApp);
                $currentApp = Appointment::where('id', '=', $appNtime[0])->first();
                $newTreatment = Treatments::where([
                    ["specialisation_id", "=", $currentApp->medicalStaff->specialisation->id],
                    ["treatmentTitle", "like", "%Consultation%"]
                ])->first();

                $currentTime = AvailableTimeslot::where('id', '=', $appNtime[1])->first();

                $sendTime = "NIL";
                switch($currentTime->blockNumber){
                    case "0":
                        $sendTime = "0900HRS - 1000HRS";
                        break;
                    case "1":
                        $sendTime = "1000HRS - 1100HRS";
                        break;
                    case "2":
                        $sendTime = "1100HRS - 1200HRS";
                        break;
                    case "3":
                        $sendTime = "1300HRS - 1400HRS";
                        break;
                    case "4":
                        $sendTime = "1400HRS - 1500HRS";
                        break;
                    case "5":
                        $sendTime = "1500HRS - 1600HRS";
                        break;
                }

                //Create new appointment
                Appointment::create([
                    "patient_id" => $currentApp->patient_id,
                    "medical_staff_id" => $currentApp->medical_staff_id,
                    "treatment_id" => $newTreatment->id,
                    "department_id" => $currentApp->department_id,
                    "appDate" => $currentTime->availDate,
                    "appTime" => $currentTime->blockNumber,
                    "status" => "awaiting"
                ]);

                //change the available timeslot status to 1 
                $currentTime->update([
                    "status" => "1"
                ]);


                $this->sendNotification($currentTime->availDate, $sendTime, $currentApp->treatment->treatmentTitle, $currentApp->medicalStaff->user->name);
            }
            elseif(Auth::user()->hasRole('nurse')){
                $appNdateNtime = explode("|", $request->bookApp);
                $currentApp = Appointment::where('id', '=', $appNdateNtime[0])->first();

                $sendTime = "NIL";
                switch($appNdateNtime[2]){
                    case "0":
                        $sendTime = "0900HRS - 1000HRS";
                        break;
                    case "1":
                        $sendTime = "1000HRS - 1100HRS";
                        break;
                    case "2":
                        $sendTime = "1100HRS - 1200HRS";
                        break;
                    case "3":
                        $sendTime = "1300HRS - 1400HRS";
                        break;
                    case "4":
                        $sendTime = "1400HRS - 1500HRS";
                        break;
                    case "5":
                        $sendTime = "1500HRS - 1600HRS";
                        break;
                }
                
                //Create new appointment
                Appointment::create([
                    "patient_id" => $currentApp->patient_id,
                    "medical_staff_id" => $currentApp->medical_staff_id,
                    "treatment_id" => $currentApp->treatment_id,
                    "department_id" => $currentApp->department_id,
                    "appDate" => $appNdateNtime[1],
                    "appTime" => $appNdateNtime[2],
                    "status" => "awaiting"
                ]);

                //Create new availableTimeslot and set the status to "1"
                AvailableTimeslot::create([
                    "medical_staff_id" => $currentApp->medical_staff_id,
                    "availDate" => $appNdateNtime[1],
                    "blockNumber" => $appNdateNtime[2],
                    "status" => "1"
                ]);
                $this->sendNotification($appNdateNtime[1], $sendTime, $currentApp->treatment->treatmentTitle, $currentApp->medicalStaff->user->name);

            }
        }

        //Insert prescription 
        if(!is_null($request->medication_name) && !is_null($request->medication_quantity)){

            //store information in database (check if health record exist pertaining to the appointment)
            if(!HealthRecord::where('appointment_id',$request->appointment)->exists())
            {
                $HR = HealthRecord::create([
                    'appointment_id' => $request->appointment
                ]);
                
                for($count = 0; $count < count($request->medication_name); $count++)
                {
                    if($request->medication_quantity[$count]){
                        Prescription::create([
                            'health_record_id'=> $HR->id,
                            'medication_id' => $request->medication_name[$count],
                            'quantity' => $request->medication_quantity[$count],
                            
                        ]);
                    }
                    
                }
            
            }
            else
            {
                $HRid = HealthRecord::select('health_records.id')
                ->where('health_records.appointment_id', 'like', '%' . $request->appointment. '%')
                ->first();

                for($count = 0; $count < count($request->medication_name); $count++)
            {
                Prescription::create([
                    'health_record_id'=> $HRid->id,
                    'medication_id' => $request->medication_name[$count],
                    'quantity' => $request->medication_quantity[$count],
                    
                ]);
            }

            }
        }

        //Insert e medical certificate 
        if(!is_null($request->duration)){
            //store information in database (check if health record exist pertaining to the appointment) 
            if(!HealthRecord::where('appointment_id',$request->appointment)->exists())
            {
                $HR = HealthRecord::create([
                    'appointment_id' => $request->appointment
                ]);
                
                EMedicalCert::create([
                    'health_record_id'=> $HR->id,
                    'startDate' => date('Y-m-d'),
                    'durationInDays' => $request->duration,
                    'remarks' => $request->remarks,
                ]);
        
            }
            else
            {
                $HRid = HealthRecord::select('health_records.id')
                ->where('health_records.appointment_id', 'like', '%' . $request->appointment. '%')
                ->first();
    
                EMedicalCert::create([
                    'health_record_id'=> $HRid->id,
                    'startDate' => date('Y-m-d'),
                    'durationInDays' => $request->duration,
                    'remarks' => $request->remarks,
                ]);
    
            }
        }
        
        Session::flash('succ', 'Consulted a patient.');
        return redirect()->back();
    }

}
