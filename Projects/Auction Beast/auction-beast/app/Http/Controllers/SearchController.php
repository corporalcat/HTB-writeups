<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(){
        return view("search");
    }

    public function search(){
        $query = request('search');
        if($query == ""){
            $res = "";
        }
        else{
            $res = DB::table('items')
            ->where('name','like',"%".$query."%")->get();
        }
        return view('search',['res' => $res]);
    }
}
