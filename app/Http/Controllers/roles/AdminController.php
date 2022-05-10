<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use App\Models\MedicalStaff;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $staffs = MedicalStaff::join('users','medical_staff.user_id','=','users.id')
        ->join('departments','medical_staff.department_id','=','departments.id')
        ->join('specialisations','medical_staff.specialisation_id','=','specialisations.id')
        ->select('medical_staff.user_id','medical_staff.id','users.name','users.email','departments.departmentName','specialisations.specialisation','users.status')
        ->get();

        $patients = Patient::join('users','patients.user_id','=','users.id')
        ->select('patients.user_id','patients.id','users.name','users.email','users.status')
        ->get();

        return view('adminDashboard.viewAccounts',[
            "staffs" => $staffs,
            "patients" => $patients
        ]);
    }

    public function suspendAcc(User $user)
    {
        $user = User::where('id','=',$user->id)->first();
        $user->update([
            'status' => 0
        ]);

        return redirect()->route('viewAccounts.view');
    }

    public function unsuspendAcc(User $user)
    {
        $user = User::where('id','=',$user->id)->first();
        $user->update([
            'status' => 1
        ]);

        return redirect()->route('viewAccounts.view');
    }
}
