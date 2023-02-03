<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use Illuminate\Http\Request ;
use App\Http\controllers\controller;



class EmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Emp::latest()->paginate(2);
        return view('index',compact('data')) ->with('i' ,(request()->input('page',1)-1)*2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
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
        $request->validate([


            'emp_name'=>'required',
            'emp_email'=>'required|email|unique:emps',
            
            'emp_image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,max_width=1000,
            min_height=100,max_height=1000'
        ]);
        $file_name=time() .'.'.request()->emp_image->getClientOriginalExtension();
        request()->emp_image->move(public_path('images'),$file_name);
        $emp=new emp;
        $emp->emp_name=$request->emp_name;
        $emp->emp_email=$request->emp_email;
        $emp->emp_gender=$request->emp_gender;
        $emp->emp_image=$file_name;
        $emp-> save();
        return redirect()->route('emp.index')->with('success','emp added successfully');


       
     

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function show(Emp $emp)
    {
        return view('show',compact('emp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function edit(Emp $emp)
    {
        //
        return view('edit',compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emp $emp)
    {
        //
        $request->validate([
            'emp_name'      =>  'required',
            'emp_email'     =>  'required|email',
            'emp_image'     =>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $emp_image = $request->hidden_emp_image;

        if($request->emp_image != '')
        {
            $emp_image = time() . '.' . request()->emp_image->getClientOriginalExtension();

            request()->emp_image->move(public_path('images'), $emp_image);
        }

        $emp = emp::find($request->hidden_id);

        $emp->emp_name = $request->emp_name;

        $emp->emp_email = $request->emp_email;

        $emp->emp_gender = $request->emp_gender;

        $emp->emp_image = $emp_image;

        $emp->save();

        return redirect()->route('emp.index')->with('success', 'Emp Data has been updated successfully');
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emp $emp)
    {
        //

        $emp->delete();
        return redirect()->route('emp.index')->with('success','Employees data deleted successfully');
    }
}
