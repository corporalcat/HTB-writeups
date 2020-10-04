<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function bid(\App\Item $item){
        $data = request()->validate([
            'price'=>['required','integer']
        ]);
        $user = auth()->user();
        $diff = request('price') - $item->price;
        if($diff>=50000 && $item->user_id != $user->id){
            if($user->wallet >= request('price')){
                $item->price = request('price');
                $item->bidder_id = $user->id;
                $item->save();
                $user->wallet -= $item->price;
                $user->save();
                return view("item.show",compact('item'));
            }
            else{
                return view("item.show",compact('item'));
            }
        }
        else{
            return view("item.show",compact('item'));
        }
    }
}
