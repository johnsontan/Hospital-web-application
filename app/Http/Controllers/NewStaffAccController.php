<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class NewStaffAccController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(){
        $departments = Department::get();
        $tt = Department::first();
        
        return view('CreateNewAccounts.newStaffAccount', ["departments" => $departments]);
    }

    public function specialty(Request $request){
        
        $department = Department::where('id', '=', $request->department)->first();
        $sp = '<option value=""> </option>';
        foreach($department->specialisation as $s){
            $sp .= '<option value="'.$s->id .'">'.$s->specialisation.'</option>'; 
        }
        return response()->json(['sp'=>$sp]);
    }

    public function department(Request $request){
        
        $dp = '<option value=""> </option>';
        if($request->role == "nurse"){
            $department = Department::where('departmentName', '=', 'Common Laboratory')->first();
            $dp .= '<option value="'. $department->id .'">'. $department->departmentName .'</option>';
        }else{
            $departments = Department::where('departmentName', '!=', 'Common Laboratory')->get();
            foreach($departments as $d){
                $dp .= '<option value="'.$d->id .'">'.$d->departmentName.'</option>'; 
            }
        }
       
        return response()->json(['dp'=>$dp]);
    }

    public function store(Request $request){
        $this->validate($request,[
            "name" => 'required|string|max:255',
            "gender" => 'required',
            "dob" => 'required|date',
            "department" => 'required',
            "specialty" => 'required',
            "age" => 'required',
            "email" => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)
            ],
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1
        ]);

        if($request->role == 'nurse'){
            $user->attachRoles(['staff', 'nurse']);
        }else{
            $user->attachRoles(['staff', 'doctor']);
        }

        $user->medicalStaff()->create([
            "department_id" => $request->department,
            "specialisation_id" => $request->specialty,
        ]);
        Session::flash('succ', 'Account successfully created.');
        return redirect()->route('adminStaffAcc.index');
    }
}
