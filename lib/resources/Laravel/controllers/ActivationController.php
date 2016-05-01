<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{    
    public function activate(Request $request) {
        $user = User::where('slug', '=', $request->route('slug'))->first();
        if ($user != null){
            if ($user->active == 0){
                $user->active = 1;
                $user->save();
                return redirect('login')->with('success','Your account is now active. Please sign in using your login credentials.');        
            }
            else{
                return redirect('login')->with('warning','Your account is already active. Please sign in using your login credentials.');        
            }
        }
        else{
            return redirect('login')->with('error','Invalid activation link. Please use the activation link emailed during registration.');
        }
    }
}
