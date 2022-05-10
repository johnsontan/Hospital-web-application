<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Medication;
use App\Models\PaymentRecords;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user){
        //Retrieve all payment records into two collections, [Completed, Consulted]
        $paymentCompleted = Appointment::where([
            ["patient_id", "=", $user->patient->id],
            ["status", "=", "completed"]
        ])->get();

        $paymentConsulted = Appointment::where([
            ["patient_id", "=", $user->patient->id],
            ["status", "=", "consulted"]
        ])->orWhere([
            ["patient_id", "=", $user->patient->id],
            ["status", "=", "paymentpending"]
        ])->orWhere([
            ["patient_id", "=", $user->patient->id],
            ["status", "=", "referred"]
        ])->orWhere([
            ["patient_id", "=", $user->patient->id],
            ["status", "=", "referral accepted"]
        ])->orWhere([
            ["patient_id", "=", $user->patient->id],
            ["status", "=", "rejected"]
        ])->get();
        return view('payment.viewPayment', ['paymentCompleted' => $paymentCompleted, 'paymentConsulted' => $paymentConsulted]);
    }

    public function invoice(Appointment $app, Request $request){
        //Validation check to prevent url injection
        if(($app->status != "consulted") && ($app->patient_id != Auth::user()->patient->id)){
            return redirect()->back();
        }

        //Forget session variable next Route
        Session::forget('nextRoute');
        
        $totalAmount = $app->treatment->price;
        //Get all medication for current appointment
        if(!is_null($app->healthRecord->first()->prescription)){
            foreach($app->healthRecord->first()->prescription as $p ){
                $totalAmount += $p->quantity * $p->medication->price;
            }
        }

           

        return view('payment.viewInvoice', ['app' => $app, 'patient' => $app->patient, 'totalAmount' => $totalAmount, 'allPrescription' => $app->healthRecord->first()->prescription]);
    }

    public function paymentByCard(Appointment $app){
        //Validation if session has otpVerified 
        if(!Session::get('otpVerified')){
            Session::put('nextRoute', 'payment.card');
            Session::put('app', $app->id);
            return redirect()->route('2fa.index');
        }
        //Forget all session related variables 
        Session::forget('otpVerified');
        Session::forget('nextRoute');
        Session::forget('app');

        //Get the grand total 
        $totalAmount = $app->treatment->price;
        //Get all medication for current appointment
        if(!is_null($app->healthRecord->first()->prescription)){
            foreach($app->healthRecord->first()->prescription as $p ){
                $totalAmount += $p->quantity * $p->medication->price;
            }
        }

        //create payment records and update appointment status
        $app->paymentRecord()->create([
            "patient_id" => $app->patient_id,
            "appointment_id" => $app->id,
            "grandTotal" => $totalAmount,
            "status" => "paid",
            "paymentType" => "card"
        ]);
        $app->update([
            "status" => "completed"
        ]);

        Session::flash('succ', 'Payment success');

        return view('payment.cardpayment', ['app' => $app, 'patient' => $app->patient]);
    }

    public function paymentByCash(Appointment $app){
        //Get the grand total 
        $totalAmount = $app->treatment->price;
        //Get all medication for current appointment
        if(!is_null($app->healthRecord->first()->prescription)){
            foreach($app->healthRecord->first()->prescription as $p ){
                $totalAmount += $p->quantity * $p->medication->price;
            }
        }

        //Create payment record and update appointment status to paymentpending
        $app->paymentRecord()->create([
            "patient_id" => $app->patient_id,
            "appointment_id" => $app->id,
            "grandTotal" => $totalAmount,
            "status" => "pending",
            "paymentType" => "cash"
        ]);

        $app->update([
            "status" => "paymentpending"
        ]);

        Session::flash('succ', 'Waiting for admin to approve payment.');

        return redirect()->route('payment.index', ['user' => Auth::user()->id]);
    }

    public function aindex(){
        $allPaymentRec = PaymentRecords::where('status', '=', 'pending')->get();
        return view('payment.aviewPayment', ['allPaymentRec' => $allPaymentRec]);
    }

    public function approvePayment(PaymentRecords $paymentRec){
        //Update payment record status to paid
        $paymentRec->update([
            "status" => "paid"
        ]);
        
        //Update appointment record status to completed
        $paymentRec->appointment()->update([
            "status" => "completed"
        ]);

        Session::flash('succ', 'Payment approved.');
        return redirect()->back();
    }
}
