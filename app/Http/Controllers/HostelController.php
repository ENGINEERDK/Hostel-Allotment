<?php

namespace App\Http\Controllers;

use App\hostels;
use App\hostelcategory;
use Illuminate\Http\Request;

// for alloting choice of hostels yearwise only
class HostelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostel = hostels::orderBy('hostel_id','ASC')->get();

        $hostelcategories = hostelcategory::all();

        return view('admin/crudhostel',compact('hostel','hostelcategories'));
            
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
        $this->validate($request,[
            'hostel_id' => 'required|unique:hostels',
            'hostelname' => 'required',
            'hostelcategory' => 'required',
            ]);
            
            $hostel= new hostels;
            $hostel->hostel_id = $request->hostel_id;
            $hostel->hostelname = $request->hostelname;
            $hostel->category = $request->hostelcategory;
            $hostel->allotedto = '0';
            $hostel->save();

            return back();
        
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hostel = hostels::where('hostel_id', $id);
        $hostel->delete();
        return back();
    }
}
