<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('item.create');
    }

    public function list(){
        $data = request()->validate([
            'name'=>'required'
            ,'image'=>['required','image']
            ,'price'=>['required','integer']
            ,'description'=>['required']
            ,'duration'=>['required','date']
            ,'category'=>['required']
            ,'tags'=>['']
            ,'time'=>['required','date_format:H:i']
            ,'size'=>['required']
        ]);
        // dd($data);
        $imagepath = (request('image')->store('uploads','public'));
        $image = Image::make(public_path("/storage/{$imagepath}"))->fit(1200,1200);
        $image->save();
        auth()->user()->items()->create([
            'name'=>$data['name'],
            'image'=>$imagepath,
            'price'=>$data['price'],
            'category'=>$data['category'],
            'tags'=>$data['tags'],
            'duration'=>$data['duration'],
            'description'=>$data['description'],
            'time'=>$data['time'],
            'size'=>$data['size']
        ]);
        return redirect('/home');
    }

    public function show(\App\Item $item){
        return view("item.show",compact('item'));
    }
}
