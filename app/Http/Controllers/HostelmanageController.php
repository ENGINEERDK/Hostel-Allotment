<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\application;
use App\hostels;
use App\floor;
use App\branch;
use App\roomtype;
use App\boyshostel;

class HostelmanageController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalhostel = hostels::get()->count();
        return view('admin/allotmentsettings',compact('totalhostel'));
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
       return $Request;
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
        $hostel = hostels::find($id);
        $hostel->delete();

        return back();
    }
    public function dashboard( $id)
    {
        //hostel name against $id
        $hostelname = hostels::where('hostel_id',$id)->first()->hostelname;

        //No on beds in that hostal
        $beds = boyshostel::where('hostel_id',$id)->count();

        //application
        $boyshostels = boyshostel::where('hostel_id',$id)->whereNotNull('regno')->orderBy('floor','ASC')->orderBy('roomno','asc')->orderBy('bedno','ASC')->get();
        return view('admin/hostelaccomodation',compact('boyshostels','id','hostelname','beds'));
    }

    public function managerooms($id)
    {
        //hostel name against $id
        $hostelname = hostels::where('hostel_id',$id)->first()->hostelname;

        $floors = floor::all();

        $roomtypes = roomtype::all();

        $branches = branch::all();

        $boyshostels = boyshostel::where([['hostel_id','=',$id],['bedno','=','1']])->orderBy('floor','DESC')->orderBy('roomno','DESC')->orderBy('bedno','DESC')->get();

        return view('admin/crudroom',compact('boyshostels','hostelname','floors','roomtypes','branches','id'));

    }
}
