<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Ichtrojan\Otp\Models\Otp;
use App\Models\MedicalStaff;
use App\Models\Department;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Features;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:patient');
    }

    public function index()
    {
        return view('patientDashboard.home');
    }

    public function show(User $user, Request $request)
    {
        
        $this->authorize('update', $user->patient);
        if(!Session::get('otpVerified')){
            Session::put('nextRoute', 'patient.show');
            return redirect()->route('2fa.index');
        }
        Session::forget('otpVerified');
        Session::forget('nextRoute');
        Session::forget('app');
        $patient = Patient::where('user_id', '=', $user->id)->first();
               
        return view('patientDashboard.billing', [
            "patient" => $patient,
        ]);
    }

    public function create(){
        
        return view('patientDashboard.addCard');
    }

    public function store(Request $request){
        
        $data = $request->validate([
            "name" => 'required|max:255',
            "creditCardNum" => 'required',
            "cvv" => 'required',
            "expDate" => 'required',
        ]);

        //Construct the exp date and the other values
        $yr = substr($request->expDate,3);
        $mth = substr($request->expDate, 0, 2);
        $expDate = "20" . $yr . "-" . $mth . "-01";
        $data["expiryDate"] = $expDate;
        $data["cardHolderName"] = $data["name"];
        unset($data["expDate"]);
        unset($data["name"]);

        //push into db
        $user = User::findOrFail(Auth::user()->id);
        $user->patient()->update([
            "creditCardNum" => $data["creditCardNum"],
            "cvv" => $data["cvv"],
            "expiryDate" => $data["expiryDate"],
            "cardHolderName" => $data["cardHolderName"],
        ]);

        Session::flash('succ', 'Credit card added.');
        return redirect()->route('patient.show', ["user" => $user->id]);
    }

    public function update(Request $request, Patient $patient){
        $data = $request->validate([
            "name" => 'required|max:255',
            "creditCardNum" => 'required',
            "cvv" => 'required',
            "expDate" => 'required',
        ]);

        //Construct the exp date and the other values
        $yr = substr($request->expDate,3);
        $mth = substr($request->expDate, 0, 2);
        $expDate = "20" . $yr . "-" . $mth . "-01";
        $data["expiryDate"] = $expDate;
        $data["cardHolderName"] = $data["name"];
        unset($data["expDate"]);
        unset($data["name"]);

        $patient->update($data);

        Session::flash('succ', 'Credit card updated.');
        return redirect()->route('patient.show', ["user" => Auth::user()->id]);
    }

    public function edit(Patient $patient){

        $this->authorize('update', $patient);

        //query the database for exp date
        $expDate = $patient->expiryDate;
        $mmyy = substr($expDate, 5,-3) . "/" . substr($expDate, 2, 2);
        
        return view('patientDashboard.editCard', ["mmyy" => $mmyy]);
    }

    public function destory(Patient $patient){
        $patient->update([
            'creditCardNum'=> null, 
            'cvv' => null,
            'expiryDate' => null,
            'cardHolderName' => null,
        ]);
       
        return redirect()->route('patient.show', ["user" => Auth::user()->id]);
    }

    public function displayDocInfoSearch()
    {
        return view('doctorInfo.searchDoctorInfo');  
    }

    public function searchDocInfo(Request $request)
    {
         //validation
         $this->validate($request, [
            'docName' => 'required_without_all:docSpecialty,docDepartment',
            'docSpecialty' => 'required_without_all:docName,docDepartment',
            'docDepartment' => 'required_without_all:docSpecialty,docName'
        ]);

        //Combined 3 tables 
        $test = MedicalStaff::join('profiles','medical_staff.user_id','=','profiles.user_id')
                        ->join('departments','medical_staff.department_id','=','departments.id')
                        ->join('specialisations','medical_staff.specialisation_id','=','specialisations.id')
                        ->select('profiles.name','specialisations.specialisation','departments.departmentName','profiles.phoneNumber')
                        ->where('name', 'like', '%' . $request->docName . '%')
                        ->where('specialisation', 'like', '%' . $request->docSpecialty . '%')
                        ->where('departmentName', 'like', '%' . $request->docDepartment . '%')
                        ->distinct()
                        ->paginate(5);
        if (count ( $test ) > 0)
                return view ('doctorInfo.viewDoctorInfo',['searchResults'=>$test]);
            
        else
            return view ('doctorInfo.viewDoctorInfo',['message'=>'No results found']);	
    }

}
