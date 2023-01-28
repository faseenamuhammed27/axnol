<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Marks;
use Session;
use Validator;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data = Students::get();
    	// dd(1);

        return view('student_list',  compact('data'));
    }
    public function studet_details()
    { 
        // $data = Students::get();
    	// dd(1);
        
        return view('add_student');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|unique:students,name,NULL,id,deleted_at,NULL',
        ]);

        if($validator->fails())
                return back()->with('error_reg','Student Name already exists');

        Students::create([
            'name'      => $request->name,
            'age'       => $request->age,
            'gender'    => $request->gender,
            'teacher'   => $request->teacher,
        ]);
      
        return back()->with('success_reg','Student Added Successfully');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Students::where('id',decrypt($id))->first();
        return view('edit_student',  compact('data'));

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
        $item = Students::where('id',decrypt($id))->first();
        $item->name     = $request->name;
        $item->country      = $request->country;
        $item->state   = $request->state;
        $item->image  = $request->image;
        $item->save();
     
        return redirect(url('/students-list'))->with('success','Student Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Students::where('id',decrypt($id))->delete();
        return back()->with('success','Student Deleted Successfully');

    }



}
