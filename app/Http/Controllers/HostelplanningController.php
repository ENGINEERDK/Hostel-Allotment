<?php

namespace App\Http\Controllers;
use App\studenthostel;
use App\hostels;
use App\year;
use Illuminate\Http\Request;

class HostelplanningController extends Controller
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
        $hostelnames = hostels::get()->where('allotedto','0');
        $fehostel = hostels::get()->where('allotedto','1');
        $sehostel = hostels::get()->where('allotedto','2');
        $tehostel = hostels::get()->where('allotedto','3'); 
        $behostel = hostels::get()->where('allotedto','4');
        $hostelalloted = ['',$fehostel,$sehostel,$tehostel,$behostel];
        $years = year::orderBy('year','ASC')->get();

        $hostel = studenthostel::orderBy('year','ASC')->get();
         return view('admin/studenthostel',compact('years','hostel','hostelnames','hostelalloted'));
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
            'year' => 'required|unique:studenthostels',
            'hostel1' => 'required',
            ]);
            
            $hostel= new studenthostel;
            $hostel->year = $request->year;
            $hostel->hostel1 = $request->hostel1;
            $hostel->hostel2 = $request->hostel2;
            $hostel->hostel3 = $request->hostel3;
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
        //dd($id);
        $hostel = hostels::where('hostel_id',$id)->first();
        $hostel->allotedto = '0';
        $hostel->save();
        //dd($hostel->hostelname);
        return back();
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
        $planning = studenthostel::where('year', $id);
        $planning->delete();

        return back();
    }
    public function hostelallot(Request $request)
    {
        //dd($request->standard,$request->hostel);
        $hostel = hostels::where('hostel_id',$request->hostel)->first();
        $hostel->allotedto = $request->standard;
        $hostel->save();
        //dd($hostel->hostelname);
        return back();
    }
}
