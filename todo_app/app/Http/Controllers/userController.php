<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    //

    public function create(){
     return view('create');
    }

    public function store(Request $request){


      $this->validate($request,[
          "name"  => "required",
          "email" => "required|email",
          "password" => "required|min:6"
      ]);



      echo 'Valid Data';
    }





public function loadData(){

    
}




}


