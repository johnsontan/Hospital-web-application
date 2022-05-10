<?php

namespace App\Http\Controllers;

use App\Mail\EmailAuth;
use App\Models\EmailAuth as ModelsEmailAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmailAuthController extends Controller
{
    public function index(Request $request){
        //Generate random 4 digits
        $code = "";
        for ($i = 0; $i<4; $i++) 
        {
            $code .= mt_rand(0,9);
        }
        Session::forget('otpVerified');       
        ModelsEmailAuth::where('email', Auth::user()->email)->delete();
        Mail::to(Auth::user()->email)->send(new EmailAuth($code));
        ModelsEmailAuth::create([
            "email" => Auth::user()->email,
            "code" => $code,
        ]);
        return view('auth.emailAuth');
    }

    public function store(Request $request){
        $dbOTP = ModelsEmailAuth::where('email', Auth::user()->email)->value('code');
        $nextRoute = $request->session()->get('nextRoute');
        Session::put('otpVerified', 'verified');

        //redirect based on Session nextRoute
        if($request->code == $dbOTP){
            Session::forget('nextRoute');
            ModelsEmailAuth::where('email', Auth::user()->email)->delete();
            if($nextRoute == "patient.show"){
                Session::flash('succ', 'OTP verified.');
                return redirect()->route('patient.show', ['user' => Auth::user()->id]);
            }
            elseif($nextRoute == "payment.card"){
                $app = $request->session()->get('app');
                Session::forget('app');
                Session::flash('succ', 'OTP verified.');
                return redirect()->route("payment.card", ['app' => $app]);
            }
            elseif($nextRoute == "medicalRecords.viewMedicalRecords"){
                $app = $request->session()->get('app');
                Session::forget('app');
                Session::flash('succ', 'OTP verified.');
                return redirect()->route("medicalRecords.viewMedicalRecords");
            }
            else{
                Session::flash('err', 'No route defined.');
                return redirect()->back();  
            }
        }
        else{
            Session::flash('err', 'Wrong OTP, sent a new OTP to your email.');
            return redirect()->back();  
        }
    }

    public function setNextRoute(Request $request){
        //Forget related session variable
        Session::forget('app');
        Session::forget('otpVerified');
        Session::forget('nextRoute');

        //Set the session var
        if($request->nextR){
            Session::put('nextRoute', $request->nextR);
        }
        if($request->app){
            Session::put('app', $request->app);
        }

        return response()->json(['success'=>$request->nextR]);
    }
    
}
