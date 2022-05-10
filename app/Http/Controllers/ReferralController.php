<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Location;
use App\Models\MedicalStaff;
use App\Models\AvailableTimeslot;
use App\Models\HealthRecord;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Treatments;
use App\Models\Referral;
use App\Models\Profile;
use App\Models\Specialisation;
use App\Models\TestResult;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        return view('referral.referToHospitalOrDept');
    }

    public function referralHospital()
    {
        $user = auth()->user();
        $staffID = MedicalStaff::where('user_id','=',$user->id)->pluck('id');
        $appointments = Appointment::where('medical_staff_id','=',$staffID)
        ->where('status', '=','consulted')->get();
        $locations = Location::get();

        $date = array(
            date('Y-m-d', strtotime('+21 days')), 
            date('Y-m-d', strtotime('+22 days')), 
            date('Y-m-d', strtotime('+23 days')),
            date('Y-m-d', strtotime('+24 days')),
            date('Y-m-d', strtotime('+25 days')),
            date('Y-m-d', strtotime('+26 days')),
            date('Y-m-d', strtotime('+27 days')),
            date('Y-m-d', strtotime('+28 days')), 
            date('Y-m-d', strtotime('+29 days')), 
            date('Y-m-d', strtotime('+30 days')),
            date('Y-m-d', strtotime('+31 days')),
            date('Y-m-d', strtotime('+32 days')),
            date('Y-m-d', strtotime('+33 days')),
            date('Y-m-d', strtotime('+34 days')),
        );

        return view('referral.referToHospital',[
            "appointments" => $appointments,
            "locations" => $locations,
            "date" =>$date
        ]);
    }

    public function storeHospital(Request $request)
    {
        $this->validate($request,[
            "appointment" =>'required',
            "location" => 'required',
            "date" =>'required|date',
            "time" => 'required',
            "memo" => 'required'
        ]);
        
        //get location
        $location = Location::where('id','=',$request->location)->first();

        //create referral
        $appointment = Appointment::where('id','=',$request->appointment)->first();
        $appointment->referral()->create([
            "location_id" => $location->id,
            "referralDate" => $request->date,
            "referralTime" => $request->time,
            "status" => "referred"
        ]);

        //change appointment status
        Appointment::where('id','=',$request->appointment)->update([
            'status' => "referred",
            'memo' => $request->memo
        ]);

        return redirect()->route('referral');
    }

    public function referralDapartment()
    {
        $user = auth()->user();
        $staffID = MedicalStaff::where('user_id','=',$user->id)->pluck('id');
        $appointments = Appointment::where('medical_staff_id','=',$staffID)
        ->where('status','=','consulted')->orWhere('status', '=', 'completed')->get();

        $department = Department::where('id', '!=', '5')->get();
        

        return view('referral.referToDepartment',[
            "appointments" => $appointments,
            "departments" =>$department
        ]);
    }

    //get Specialisation data
    public function sp(Request $request)
    {
        $spGet = Specialisation::where('department_id','=',$request->department)->get();
        $sp = "";
        $sp .= '<option value=""> </option>';

        foreach($spGet as $s){
            $sp .= '<option value="'.$s->id.'">'.$s->specialisation.'</option>';            
        }
        return response()->json(['sp'=>$sp]);
    }

    //get staff data
    public function medicalStaff(Request $request)
    {
        $user = auth()->user();
        $staffID = MedicalStaff::where('user_id','=',$user->id)->pluck('id');
        $d = Specialisation::where('id', '=', $request->specialisation)->first();
        $ms = $d->medicalStaff()->where('id','!=',$staffID)->get();
        $doctors = "";
        $doctors .= '<option value=""> </option>';   
        foreach($ms as $m){
            $doctors .= '<option value="'.$m->id.'"> Dr '.$m->user->name.'</option>';            
        }
        return response()->json(['doctors'=>$doctors]);
    }

    //get staff available date
    public function availDate(Request $request)
    {
        $ms = MedicalStaff::where('id', '=', $request->ms)->first();
        $availTimeslots = $ms->availableTimeslot()->select('medical_staff_id', 'availDate', 'status')->distinct()->get();
        $ats = "";
        $ats .= '<option value=""> </option>';
        foreach($availTimeslots as $m){
            if($m->status == "0"){
                $ats .= '<option value="'.$m->medical_staff_id.'|'.$m->availDate.'">'.$m->availDate.'</option>'; 
            }
        }
        return response()->json(['ats'=>$ats]);
    }

    //get staff available time
    public function availTime(Request $request)
    {
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
        return response()->json(['blockNum'=>$blockNum]);
    }

    public function storeDepartment(Request $request)
    {
        $this->validate($request,[
            "appointment" =>'required',
            "department" => 'required',
            "specialisation" => 'required',
            "medicalStaff" => 'required',
            "date" =>'required',
            "time" => 'required',
            "memo" => 'required'
        ]);

        //get date and time
        $msDate = explode("|", $request->date);
        $date = $msDate[1];
        $timeArray = explode("|", $request->time);
        $time = $timeArray[0];
        $ms = MedicalStaff::where('id','=',$request->medicalStaff)->first();

        //create referral
        $appointment = Appointment::where('id','=',$request->appointment)->first();
        $appointment->referral()->create([
            "medical_staff_id" => $ms->id,
            "referralDate" => $date,
            "requestedTime" => $time,
            "status" => "pending"
        ]);

        //change appointment status
        Appointment::where('id','=',$request->appointment)->update([
            'status' => "pending",
            'memo' => $request->memo
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
            }
        }

        return redirect()->route('referral');
    }

    public function view(Request $request)
    {
        $user = auth()->user();

        if(Auth::user() && $request->user()->hasRole('staff'))
        {
            $staffID = MedicalStaff::where('user_id','=',$user->id)->pluck('id');
        
            $result = Referral::join('appointments','referrals.appointment_id','=','appointments.id')
            ->select('referrals.id','referrals.appointment_id','referrals.referralDate','referrals.requestedTime','appointments.memo')
            ->where('referrals.medical_staff_id','=',$staffID)
            ->where('referrals.status','=','pending')
            ->get();
            return view('referral.viewReferrals' , [
                'referral'=>$result
            ]);
        }
        
        else if (Auth::user() && $request->user()->hasRole('patient'))
        {
            $patientID = Patient::where('user_id','=',$user->id)->pluck('id');

            $referrals = Referral::join('appointments', 'referrals.appointment_id','=','appointments.id')
            ->join('locations','referrals.location_id','=','locations.id')
            ->select('referrals.id','referrals.referralDate','referrals.referralTime','locations.hospitalName')
            ->where('appointments.patient_id','=',$patientID)
            ->where('referrals.status','=','referred')
            ->distinct()
            ->get();

            return view('referral.patientViewReferrals',[
                'referrals' => $referrals
            ]);
        }
    }

    public function accept(Referral $referral)
    {
        $referral = Referral::where('id', '=',$referral->id)->first();
        $referral->update([
            "status"=>"accepted"
        ]);
        //
        $ms = MedicalStaff::where('id','=',$referral->medical_staff_id)->first();
        $t = Treatments::where('specialisation_id','=',$ms->specialisation_id)->first();
        $p = Appointment::where('id','=',$referral->appointment_id)->first();
        Appointment::create([
            "patient_id" => $p->patient_id,
            "medical_staff_id" => $ms->id,
            "treatment_id" => $t->id,
            "department_id" => $ms->id,
            "appDate" => $referral->referralDate,
            "appTime" => $referral->requestedTime,
            "status" => "awaiting",
        ]);
        Appointment::where('id','=',$referral->appointment_id)
        ->update([
            "status"=>"referral accepted"
        ]);
        return redirect()->route('referral.view');
    }

    public function reject(Referral $referral)
    {
        $referral = Referral::where('id', '=',$referral->id)->first();

        //changed status to 0 [available] 
        $iATS = AvailableTimeslot::where([
            ['medical_staff_id', '=', $referral->medical_staff_id],
            ['availDate', '=', $referral->referralDate],
            ['blockNumber', '=', $referral->requestedTime],
            ['status', '=', '1']
        ])->first();
        $iATS->update([
            "status" => "0",
        ]);

        $referral->update([
            "status" => "rejected"
        ]);

        Appointment::where('id','=',$referral->appointment_id)
        ->update([
            "status"=>"awaiting"
        ]);
        return redirect()->route('referral.view');
    }

    public function apptMemo(Request $request)
    {
        $appt = Appointment::where('id', '=', $request->appointment)->first();
        $m = $appt->memo;
        
        return response()->json(['memo'=>$m]); 
    }

    public function print(Referral $referral)
    {
        $user = auth()->user();

        $referrals = Referral::join('appointments', 'referrals.appointment_id','=','appointments.id')
            ->join('locations','referrals.location_id','=','locations.id')
            ->select('referrals.id','referrals.referralDate','referrals.referralTime','locations.hospitalName','locations.address','locations.city','locations.postalCode','appointments.memo','appointments.medical_staff_id','referrals.appointment_id')
            ->where('referrals.id','=',$referral->id)
            ->distinct()
            ->first();
        
        //get patient details
        $patient = Profile::where('user_id','=',$user->id)->first();

        //get doctor details
        $ms = MedicalStaff::join('departments','medical_staff.department_id','=','departments.id')
            ->join('specialisations','medical_staff.specialisation_id','=','specialisations.id')
            ->join('profiles','medical_staff.user_id','=','profiles.user_id')
            ->select('profiles.name','departments.departmentName','specialisations.specialisation')
            ->where('medical_staff.id','=',$referrals->medical_staff_id)
            ->distinct()
            ->first();
 

        $hr = HealthRecord::where('appointment_id','=',$referral->appointment_id)->distinct()->first();
        if(Prescription::where('health_record_id','=',$hr->id)->exists())
        {
            $prescriptions = Prescription::join('medications','prescriptions.medication_id','=','medications.id')
            ->select('medications.medicationName','prescriptions.quantity')
            ->where('health_record_id','=',$hr->id)
            ->get();
        }
        else
        {
            $prescriptions = "";
        }

        if(TestResult::where('health_record_id','=',$hr->id)->exists())
        {
            $testResults = TestResult::where('health_record_id','=',$hr->id)->get();
        }
        else
        {
            $testResults = "";
        }
       
        return view('referral.printReferral', [
            'referrals'=>$referrals,
            'patient'=>$patient,
            'ms'=>$ms,
            'prescriptions'=>$prescriptions,
            'testResults'=>$testResults
        ]);
    }
}