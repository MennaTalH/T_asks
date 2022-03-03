<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = task::join('users', 'users.id', '=', 'task.user_id')->select('task.*', 'users.name as userName')->get();

        return view('task.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data =   $this->validate($request, [
            "title"   => "required|max:100",
            "content" => "required|max:5000",
            "image"   => "required|image|mimes:png,jpg"  ,
            "start date" => "required",
            "end date" => "required"
        ]);

        $FinalName = time() . rand() . '.' . $request->image->extension();

        if ($request->image->move(public_path('taskImages'), $FinalName)) {


            $data['image'] = $FinalName;
            $data['user_id'] = auth()->user()->id;

            $op = task::create($data);

            if ($op) {
                $message = 'data inserted';
            } else {
                $message =  'error try again';
            }
        } else {
            $message = "Error In Uploading File ,  Try Again ";
        }

        session()->flash('Message', $message);

        return redirect(url('/TODO'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = task::find($id);

        return view('task.show', ['data' => $data]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = task::find($id);

        return view('task.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $data =   $this->validate($request, [
            "title"   => "required|max:100",
            "content" => "required|max:5000",
            "image"   => "required|image|mimes:png,jpg"  ,
            "start date" => "required",
            "end date" => "required"
        ]);

      
        $objData = task::find($id);


        if ($request->hasFile('image')) {

            $FinalName = time() . rand() . '.' . $request->image->extension();

            if ($request->image->move(public_path('taskImages'), $FinalName)) {

                unlink(public_path('taskImages/' . $objData->image));
            }
        } else {
            $FinalName = $objData->image;
        }


        $data['image'] = $FinalName;

       

        $op = task::find($id)->update($data);

      

        if ($op) {
            $message = 'Raw Updated';
        } else {
            $message =  'error try again';
        }

        session()->flash('Message', $message);

        return redirect(url('/TODO'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $data =  task::find($id);

        $op =  task::find($id)->delete();
        if ($op) {
            unlink(public_path('taskImages/' . $data->image));
            $message = "Raw Removed";
        } else {
            $message = "Error Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/TODO'));
    }
}
