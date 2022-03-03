<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\users;

class usersController extends Controller
{
    //

     public function index(){
        

        $data =  users :: orderBy('id','desc')->get();


         return view('users.index',["data" => $data]);
       
     }




    public function create(){
        return view('users.create');
       }


       public function Store(Request $request){
           // code .....

       $data =  $this->validate($request,[
               "name"     => "required|min:3",
               "email"    => "required|email",
               "password" => "required|min:6"
        ]);


       $data['password'] = bcrypt($data['password']);

       $op = users :: create($data);

        if($op){
            $message = 'data inserted';
        }else{
            $message =  'error try again';
        }

        session()->flash('Message',$message);

        return redirect(url('/Users/'));



       }



  public function edit($id){

    $data = users :: find($id);

       return view('users.edit',["data" => $data]);
  }


  public function update(Request $request,$id){


    $data =  $this->validate($request,[
        "name"     => "required|min:3",
        "email"    => "required|email"
      ]);

     $op =  users :: where('id',$id)->update($data);

     if($op){
        $message = 'Raw Updated';
    }else{
        $message =  'error try again';
    }

    session()->flash('Message',$message);

    return redirect(url('/Users/'));

  }
    public function delete($id){
     
      $op =  users::find($id)->delete();
      if($op){
         $message = "Raw Removed";
      }else{
         $message = 'Error Try Again';
      }

       session()->flash('Message',$message);

       return redirect(url('/Users/'));

       }




       public function login(){
           return view('users.login');
       }


       public function doLogin(Request $request){

        $data =  $this->validate($request,[
            "password"  => "required|min:6",
            "email"     => "required|email"
          ]);


          if(auth()->attempt($data)){

           return redirect(url('/Users'));

          }else{
              session()->flash('Message','invalid Data');
              return redirect(url('/Users/Login'));
          }


       }




       public function LogOut(){
           // code .....

           auth()->logout();
           return redirect(url('/Users/Login'));
       }


}


