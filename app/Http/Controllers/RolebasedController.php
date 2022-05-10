<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RoleBasedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function lapseAppointment($tdyDate){
        //Lapse appointment
        $lapseApp = Appointment::where([
            ['appDate', '<', $tdyDate],
            ['status', '=', 'awaiting']
        ])->get();
        if($lapseApp){
            foreach($lapseApp as $app){
                $app->update([
                    "status" => "lapse"
                ]);
            }
        }
    }

    public function index(Request $request){
        if(Auth::user() && $request->user()->hasRole('admin')){
            $user = auth()->user();
            return view('adminDashboard.home', [
                "user" => $user,
            ]);
        }
        elseif(Auth::user() && $request->user()->hasRole('staff')){
            $user = auth()->user();        

            //Define today date
            $tdyDate = date('Y-m-d');
            $upcomingApp = Appointment::where([
                ['appDate', '>=', $tdyDate],
                ['medical_staff_id', '=', $user->medicalStaff->id],
                ['status', '=', 'awaiting'],
            ])->get();

            $this->lapseAppointment($tdyDate);

            return view('staffDashboard.home', [
                "user" => $user,
                "upcomingApp" => $upcomingApp,
            ]);
        }
        elseif(Auth::user() && $request->user()->hasRole('patient')){
            $user = auth()->user();
            
            //Retrieve records from patient based on user and create patient record if null.
            $patient = Patient::where('user_id', '=', $user->id)->first();
            if(is_null($patient)){
                $user->patient()->create([
                    'user_id' => $user->id,
                ]);
            }
            //Define today date
            $tdyDate = date('Y-m-d');
            
            //Get upcoming and past appointment records
            $upcomingApp = Appointment::where([
                ['appDate', '>=', $tdyDate],
                ['patient_id', '=', $user->patient->id],
                ['status', '=', 'awaiting']
            ])->get();

            $this->lapseAppointment($tdyDate);
            
            return view('patientDashboard.home', [
                "user" => $user,
                "upcomingApp" => $upcomingApp
            ]);
        }
        else{
            Auth::logout();
            return redirect()->route('welcome');
        }
    }

    public function viewcp(User $user){
        if(Auth::user()->id != $user->id){
            Session::flash('err', 'Not authorized to change password.');
            return redirect()->back();
        }
        return view('viewcp', ['user' => $user]);
    }

    public function updatePassword(Request $request){

        //Validation check
        if(!Hash::check($request->ppassword, Auth::user()->password)){
            Session::flash('err', 'wrong password');
            return redirect()->back();
        }
        $this->validate($request, [
            'password' => 'required|min:8|confirmed'
        ]);

        //Update the password
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Session::flash('succ', 'Password updated');
        return redirect()->route('profile.show', ['user' => Auth::user()->id]);
    }
}
