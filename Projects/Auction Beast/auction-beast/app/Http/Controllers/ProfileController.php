<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(\App\User $user){
        return view("profiles.edit",compact('user'));
    }

    public function show(\App\User $user){
        return view("profiles.show",compact('user'));
    }

    public function update(\App\User $user){
        $data = request()->validate([
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'city'=>'required',
            'pos'=>'required'
        ]);
        $user->update($data);
        return redirect("/profile/{$user->id}");
    }
}
