<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\EducationalMaterial;
use App\Models\EMedicalCert;
use App\Models\Medication;
use App\Models\TestResult;
use App\Models\Prescription;
use App\Models\HealthRecord;
use App\Models\MedicalStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class medicalRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function displayCreatePage()
    {
        //For admins to go to the create medical records page
        return view('medicalRecords.addRecords');
    }

    public function storeTestResults(Request $request)
    {
        //validation
        $rules = [
                'appID' => 'required',
                'remarks' =>'required',
                'exampleCheck1' =>'accepted'
            ];

        $customMessages = [
            'appID' => 'The appointment is required.',
            'remarks.required' => 'The remarks field is required.',
            'exampleCheck1.accepted' => 'Please confirm.',
            
         ];

        $this->validate($request,$rules,$customMessages);

        //store information in database 
        if(!HealthRecord::where('appointment_id',$request->appID)->exists())
        {
            $HR = HealthRecord::create([
                'appointment_id' => $request->appID
            ]);
            TestResult::create([
                'health_record_id'=> $HR->id,
                'content' => $request->remarks,
            ]);
    
        }
        else
        {
            $HRid = HealthRecord::select('health_records.id')
            ->where('health_records.appointment_id', 'like', '%' . $request->appID. '%')
            ->first();

            TestResult::create([
                'health_record_id'=> $HRid->id,
                'content' => $request->remarks,
            ]);

        }
       
        //Redirect to the same page
        Session::flash('succ', 'Test Result has been created successfully');
        return redirect()->back();
        
        }

    public function storeMedCert(Request $request) //Deprecated [Remove it]
    {
         //validation
         $rules = [
            'appID' => 'required',
            'startDate' =>'required|date',
            'duration' =>'required|integer',
            'remarks' =>'required',
            'exampleCheck1' =>'accepted'
        ];

        $customMessages = [
            'appID.required' => 'The appointment is required.',
            'startDate.required' => 'The start date field is required.',
            'startDate.date' => 'The start date field needs to be a date in this format (YYYY-MM-DD).',
            'duration.required' => 'The duration field is required.',
            'duration.integer' => 'The duration field needs to be an integer.',
            'remarks.required' => 'The remarks field is required.',
            'exampleCheck1.accepted' => 'Please confirm.',
            
        ];

        $this->validate($request,$rules,$customMessages);

         //store information in database 
         if(!HealthRecord::where('appointment_id',$request->appID)->exists())
         {
             $HR = HealthRecord::create([
                 'appointment_id' => $request->appID
             ]);
             
             EMedicalCert::create([
                'health_record_id'=> $HR->id,
                'startDate' => $request->startDate,
                'durationInDays' => $request->duration,
                'remarks' => $request->remarks,
            ]);
     
         }
         else
         {
             $HRid = HealthRecord::select('health_records.id')
             ->where('health_records.appointment_id', 'like', '%' . $request->appID. '%')
             ->first();
 
             EMedicalCert::create([
                'health_record_id'=> $HRid->id,
                'startDate' => $request->startDate,
                'durationInDays' => $request->duration,
                'remarks' => $request->remarks,
            ]);
 
         }
        

        //Redirect to the same page
        Session::flash('succ', 'Medical certificate has been created successfully');
        return redirect()->back();
    }
        

    public function storePrescription(Request $request) //Deprecated [Remove it]
    {
        
         //validation
         $rules = [
            'appID' => 'required',
            'medication_name.*' => 'required',
            'medication_quantity.*' => 'required',
            'exampleCheck1' =>'accepted'
        ];
        
        $customMessages = [
            'appID.required' => 'Appointment is required.',
            'medication_name.required' => 'Medication name is required',
            'medication_quantity.required' => 'Quantity is required',
            'exampleCheck1.accepted' => 'Please confirm.',
            
        ];

        $this->validate($request,$rules,$customMessages);

        //store information in database 
        if(!HealthRecord::where('appointment_id',$request->appID)->exists())
        {
            $HR = HealthRecord::create([
                'appointment_id' => $request->appID
            ]);
            
           for($count = 0; $count < count($request->medication_name); $count++)
           {
               Prescription::create([
                   'health_record_id'=> $HR->id,
                   'medication_id' => $request->medication_name[$count],
                   'quantity' => $request->medication_quantity[$count],
                  
               ]);
           }
          
        }
        else
        {
            $HRid = HealthRecord::select('health_records.id')
            ->where('health_records.appointment_id', 'like', '%' . $request->appID. '%')
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
        //Redirect to the same page
        Session::flash('succ', 'Prescription has been created successfully');
        return redirect()->back();
    }
    
    public function displayPrescription()
    {
        //Get medical staff
        $ms = MedicalStaff::where('id', '=', Auth::user()->medicalStaff->id)->first();

        //Get all appointments related to medical staff
        $allAppointments = Appointment::where([
            ['medical_staff_id', '=', $ms->id],
            ['status', '=', 'consulted']
        ])->get();

        $medications =  Medication::all();
        return view('medicalRecords/addPrescription',['medications'=>$medications, 'allAppointments' => $allAppointments]);
    }

    public function viewMedicalRecords()
    {
        //verify user has otp verified
        if(!Session::get('otpVerified')){
            Session::put('nextRoute', 'medicalRecords.viewMedicalRecords');
            return redirect()->route('2fa.index');
        }
        Session::forget('otpVerified');
        Session::forget('nextRoute');
        Session::forget('app');

        if (Auth::user()->hasRole('patient'))
        {

             //Combine appointment table and healthrecords table to get the patient's health records
            $medicalRecords = HealthRecord::join('appointments','health_records.appointment_id','=','appointments.id')
            ->select('health_records.appointment_id','health_records.id','health_records.created_at')
            ->where('appointments.patient_id', 'like', '%' . Auth::user()->Patient->id. '%')
            ->distinct()
            ->get();

            if (count ( $medicalRecords ) > 0)
            return view ('medicalRecords.ViewHealthRecords',['medicalRecords'=>$medicalRecords]);
            else
            return view ('medicalRecords.ViewHealthRecords',['message'=>'No results found']);	

        }

        if (Auth::user()->hasRole('staff'))
        {

             //Show staffs the records of patients under them 
            $medicalRecords = HealthRecord::join('appointments','health_records.appointment_id','=','appointments.id')
            ->join('patients','appointments.patient_id','=','patients.id')
            ->join('profiles','patients.user_id','=','profiles.user_id')
            ->select('profiles.name','health_records.appointment_id','health_records.id','health_records.created_at')
            ->where('appointments.medical_staff_id', 'like', '%' . Auth::user()->medicalStaff->id. '%')
            ->distinct() 
            ->get();

            if (count ( $medicalRecords ) > 0)
            return view ('medicalRecords.staffViewHealthRecords',['medicalRecords'=>$medicalRecords]);
            else
            return view ('medicalRecords.staffViewHealthRecords',['message'=>'No results found']);	

        }
       
       
    }

    public function viewMoreMedicalRecords($id)
    {
       

        //Get test result and MC based on medical record (Can use ->first() because there should only be 1 row of data )
        $testResults = HealthRecord::join('test_results','health_records.id','=','test_results.health_record_id')
        ->select('test_results.id','test_results.content')
        ->where('health_records.id', 'like', '%' . $id . '%')
        ->first();

        $medCert = HealthRecord::join('e_medical_certs','health_records.id','=','e_medical_certs.health_record_id')
        ->select('e_medical_certs.id','e_medical_certs.created_at','e_medical_certs.durationInDays','e_medical_certs.remarks')
        ->where('health_records.id', 'like', '%' . $id . '%')
        ->first();

        //get prescriptions based on medical record 
        $prescriptions =  HealthRecord::join('prescriptions','health_records.id','=','prescriptions.health_record_id')
        ->join('medications','prescriptions.medication_id','=','medications.id')
        ->select('prescriptions.id','prescriptions.health_record_id','medications.medicationName','prescriptions.quantity')
        ->where('health_records.id', 'like', '%' . $id . '%')
        ->get();

        if (Auth::user()->hasRole('staff'))
        {
            //Get patient name and go  to staff's see more health records view
            $test = HealthRecord::join('appointments','health_records.appointment_id','=','appointments.id')
            ->join('patients','appointments.patient_id','=','patients.id')
            ->join('profiles','patients.user_id','=','profiles.user_id')
            ->select('profiles.name','health_records.created_at','health_records.appointment_id')
            ->where('health_records.id', 'like', '%' . $id . '%')
            ->first();
            return view('medicalRecords.staffSeeMoreViewHealthRecords',['medicalRecord'=>$test,'testResults'=>$testResults,'prescriptions'=>$prescriptions,'medCert'=>$medCert]);

        }
        else
        {
             //Get one record of the medical record which matches the id 
            $test = HealthRecord::join('appointments','health_records.appointment_id','=','appointments.id')
            ->join('medical_staff','appointments.medical_staff_id','=','medical_staff.id')
            ->join('profiles','medical_staff.user_id','=','profiles.user_id')
            ->select('profiles.name','health_records.created_at','health_records.appointment_id')
            ->where('health_records.id', 'like', '%' . $id . '%')
            ->first();
            return view('medicalRecords.seeMoreViewHealthRecords',['medicalRecord'=>$test,'testResults'=>$testResults,'prescriptions'=>$prescriptions,'medCert'=>$medCert]);
        }

        
    }

    public function createMedCert(){
        //Get medical staff
        $ms = MedicalStaff::where('id', '=', Auth::user()->medicalStaff->id)->first();

        //Get all appointments related to medical staff
        $allAppointments = Appointment::where([
            ['medical_staff_id', '=', $ms->id],
            ['status', '=', 'consulted']
        ])->get();

        return view('medicalRecords.addMedCert', ['allAppointments' => $allAppointments]);
    }

    public function createTestResults(){
        //Get medical staff
        $ms = MedicalStaff::where('id', '=', Auth::user()->medicalStaff->id)->first();

        //Get all appointments related to medical staff
        $allAppointments = Appointment::where([
            ['medical_staff_id', '=', $ms->id],
            ['status', '=', 'completed']
        ])->orWhere([
            ['medical_staff_id', '=', $ms->id],
            ['status', '=', 'consulted']
        ])->orWhere([
            ['medical_staff_id', '=', $ms->id],
            ['status', '=', 'paymentpending']
        ])
        ->get();
        
        return view('medicalRecords.addTestResults', ['allAppointments' => $allAppointments]);
    }

    public function viewMedicalCert($id)
    {
        $medicalCert = EMedicalCert::join('health_records','e_medical_certs.health_record_id','=','health_records.id')
        ->join('appointments','health_records.appointment_id','=','appointments.id')
        ->join('medical_staff','appointments.medical_staff_id','=','medical_staff.id')
        ->join('patients','appointments.patient_id','=','patients.id')
        ->join('profiles','medical_staff.user_id','=','profiles.user_id')
        ->select('profiles.name','e_medical_certs.id','e_medical_certs.startDate','e_medical_certs.durationInDays')
        ->where('e_medical_certs.id', 'like', '%' . $id . '%')
        ->first();

        $patientName = EMedicalCert::join('health_records','e_medical_certs.health_record_id','=','health_records.id')
        ->join('appointments','health_records.appointment_id','=','appointments.id')
        ->join('patients','appointments.patient_id','=','patients.id')
        ->join('profiles','patients.user_id','=','profiles.user_id')
        ->select('profiles.name')
        ->where('e_medical_certs.id', 'like', '%' . $id . '%')
        ->first();
       
        return view('medicalRecords.printMC',['medicalCert'=>$medicalCert],['patientName'=>$patientName]);
    }

    public function destroyCert(EMedicalCert $record)
    {
        $record->delete();
        Session::flash('succ', 'Medical Certificate has been deleted successfully');
        return redirect()->back();
    
    }

    public function destroyPrescription(Request $request)
    {
       
            $prescription = $request->prescriptionData;
            foreach ($prescription as $prescriptionID)
            {
                $prescription= Prescription::find($prescriptionID);
                $prescription->delete();  
            } 
            Session::flash('succ', 'Prescription has been deleted successfully');
            return redirect()->back();
           
    }

    public function destroyTestResult(TestResult $record)
    {
        $record->delete();  
        Session::flash('succ', 'Test result has been deleted successfully');
        return redirect()->back();
    }

    public function editCert($medcert)
    {
        //Get one record of the medicalcert which matches the id 
        $medCert= EMedicalCert::join('health_records','e_medical_certs.health_record_id','=','health_records.id')
        ->join('appointments','health_records.appointment_id','=','appointments.id')
        ->select('e_medical_certs.id as certID','appointments.id as apptID','e_medical_certs.startDate','e_medical_certs.durationInDays','e_medical_certs.remarks')
        ->where('e_medical_certs.id', 'like', '%' . $medcert . '%')
        ->first();
        return view('medicalRecords.staffEditMedCert',['medCert'=>$medCert]);
    }

    public function updateCert(Request $request,$id)
    {
         //validation
         $rules = [
            'appID' => 'required',
            'startDate' =>'required|date',
            'duration' =>'required|integer',
            'remarks' =>'required',
            'exampleCheck1' =>'accepted'
        ];

        $customMessages = [
            'appID.required' => 'The appointment is required.',
            'startDate.required' => 'The start date field is required.',
            'startDate.date' => 'The start date field needs to be a date in this format (YYYY-MM-DD).',
            'duration.required' => 'The duration field is required.',
            'duration.integer' => 'The duration field needs to be an integer.',
            'remarks.required' => 'The remarks field is required.',
            'exampleCheck1.accepted' => 'Please confirm.',
            
        ];


        $this->validate($request,$rules,$customMessages);
        
        //Update the medical certificate record 
        $medicalCert = EMedicalCert::find($id);
        $medicalCert->startDate = $request->startDate;
        $medicalCert->durationInDays = $request->duration;
        $medicalCert->remarks = $request->remarks;
        $medicalCert->save();


         //Redirect to the same page
         Session::flash('succ', 'Medical Certificate has been updated successfully');
         return redirect()->back();
        
    }

    public function editTestResult($testresult)
    {
        //Get one record of the test result which matches the id 
        $testResult= TestResult::join('health_records','test_results.health_record_id','=','health_records.id')
        ->join('appointments','health_records.appointment_id','=','appointments.id')
        ->select('test_results.id as trID','appointments.id as apptID','test_results.content')
        ->where('test_results.id', 'like', '%' . $testresult . '%')
        ->first();
        return view('medicalRecords.staffEditTestResults',['testResult'=>$testResult]);
    }
   
    public function updateTestResult(Request $request,$id)
    {
         //validation
         $rules = [
            'appID' => 'required',
            'remarks' =>'required',
            'exampleCheck1' =>'accepted'
        ];

        $customMessages = [
            'appID.required' => 'The appointment is required.',
            'remarks.required' => 'The remarks field is required.',
            'exampleCheck1.accepted' => 'Please confirm.',
            
        ];
        
        $this->validate($request,$rules,$customMessages);
        
        //Update the medical certificate record 
        $testResult = TestResult::find($id);
        $testResult->content = $request->remarks;
        $testResult->save();


         //Redirect to the same page
         Session::flash('succ', 'Test Result has been updated successfully');
         return redirect()->back();
        
    }

    public function editPrescription($prescription)
    {
        //Get records of the prescription which matches the id 
        $prescriptions = Prescription::join('health_records','prescriptions.health_record_id','=','health_records.id')
        ->join('medications','prescriptions.medication_id','=','medications.id')
        ->join('appointments','health_records.appointment_id','=','appointments.id')
        ->select('appointments.id as apptID','prescriptions.id as prescriptionID','prescriptions.health_record_id','medications.medicationName','prescriptions.quantity')
        ->where('health_records.id', 'like', '%' . $prescription . '%')
        ->get();

        $medications =  Medication::all();
        return view('medicalRecords.staffEditPrescription',['prescriptions'=>$prescriptions, 'medications'=>$medications]);
    }

    public function updatePrescription(Request $request,$id)
    {
        //validation
        $rules = [
            'appID' => 'required',
            'medication_name.*' => 'required',
            'medication_quantity.*' => 'required',
            'exampleCheck1' =>'accepted'
        ];
        
        $customMessages = [
            'appID.required' => 'Appointment is required.',
            'medication_name.required' => 'Medication name is required',
            'medication_quantity.required' => 'Quantity is required',
            'exampleCheck1.accepted' => 'Please confirm.',
            
        ];

        $this->validate($request,$rules,$customMessages);

        //Delete current records
        $deletedRows = Prescription::where('health_record_id',$id)->delete();
       
        //Create new records
         for($count = 0; $count < count($request->medication_name); $count++)
         {
             Prescription::create([
                 'health_record_id'=> $id,
                 'medication_id' => $request->medication_name[$count],
                 'quantity' => $request->medication_quantity[$count],
                
             ]);
         }
        //Redirect to the same page
        Session::flash('succ', 'Prescription has been updated successfully');
        return redirect()->back();
    }
}

