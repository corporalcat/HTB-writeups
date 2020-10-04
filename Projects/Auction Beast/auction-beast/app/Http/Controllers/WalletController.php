<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function update(\App\User $user){
        return view("wallet.topup",compact('user'));
    }
    public function topup(\App\User $user){
        $data = request()->validate([
            'wallet'=>['required','integer']
        ]);
        $new_balance = $user->wallet + $data['wallet'];
        $user->wallet = $new_balance;
        $user->save();
        return redirect('/home');
    }
}


