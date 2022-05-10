<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|patient|staff');
    }

    public function show($user)
    {
        $user = User::findOrFail($user);
        if($user->hasRole('admin')){
            $this->authorize('update', $user->profile);
            return view('adminDashboard.profile', [
                "user" => $user,
            ]);
        }
        elseif($user->hasRole('staff')){
            $this->authorize('update', $user->profile);
            return view('staffDashboard.profile', [
                "user" => $user,
            ]);
        }
        elseif($user->hasRole('patient')){
            $this->authorize('update', $user->profile);
            return view('patientDashboard.profile', [
                "user" => $user,
            ]);
        }
        else{
            Auth::logout();
            return redirect()->route('welcome');
        }
    }

    public function edit(User $user, Request $request){
        $this->authorize('update', $user->profile);
        return view('profile.edit', ['user'=>$user]);
    }

    public function update(User $user, Request $request){
        $this->authorize('update', $user->profile);
        $data = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'phoneNumber' => 'required',
            'dob' => 'required',
            'age' => 'required',
        ]);

        $user->profile->update($data);

        Session::flash('succ', 'Profile updated.');
        return redirect()->route('profile.show', ['user' => $user->id]);
    }

}
