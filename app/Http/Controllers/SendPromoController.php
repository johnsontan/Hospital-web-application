<?php

namespace App\Http\Controllers;

use App\Mail\PromoMail;
use App\Models\PromotionalMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SendPromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(Request $request){
        $promomsg = PromotionalMessage::get();
        return view('promotionalmsg.viewpromo', ['promomsg'=> $promomsg]);
    }

    public function store(Request $request){
        $request->validate([
            "title" => "required",
            "promoDesc" => "required",
            "exampleCheck1" => "accepted",
        ]);

        PromotionalMessage::create([
            "title" => $request->title,
            "promoDesc" => $request->promoDesc,
        ]);

        $promomsg = PromotionalMessage::where("promoDesc", $request->promoDesc)->first();
        if($promomsg){
            $this->sentList($promomsg);
            Session::flash('succ','Promotional message sent to all users');
            return redirect()->route('promomenu.index');
        }else{
            Session::flash('err','Promotional message sent to all users');
            return redirect()->route('promomenu.index');
        }

    }

    public function create(){
        return view('promotionalmsg.createpromo');
    }

    public function detailPromo(PromotionalMessage $promomsg){

        $allUsersEmail = "";
        foreach($promomsg->showRecipients()->get() as $eaUser){
            $allUsersEmail .= $eaUser->email . " | ";
        }

        return view('promotionalmsg.detailpromo', ['promomsg' => $promomsg, 'allUsersEmail' => $allUsersEmail]);
    }

    private function sentList(PromotionalMessage $promomsg){
        $allUsers = User::join('patients', 'users.id', '=', 'patients.user_id')->get();
        foreach($allUsers as $user){
            $u = User::where('id', $user->user_id)->first();
            Mail::to($u->email)->send(new PromoMail($promomsg->title, $promomsg->promoDesc));
            $u->showPromos()->toggle($promomsg);
        }
    }
}
