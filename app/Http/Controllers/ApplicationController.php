<?php

namespace App\Http\Controllers;
use App\application;
use App\boyshostel;
use App\hostels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('edit','show','destroy');
        $this->middleware('auth:admin', ['only' => ['edit','show','destroy']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = boyshostel::where('regno',Auth::user()->regno)->first();
        if(!is_null($result))
        {
            $application = application::where('regno',Auth::user()->regno)->first();
            $roommates = boyshostel::where([['roomno',$application->roomno],['hostel_id',$application->hostel_id]])->get();
            return view('user/dashboard', compact('result','application','roommates')); 
        }
        
        return view('user/acknowledgement');
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
            'regno'=>'required',
            'rollno' => 'required',
            'name' => 'required',
            'year'=>'required',
            'branch' => 'required',
            'marks' => 'required',
            ]);
       $application= new application;

        $application->regno = $request->regno;
        $application->rollno = $request->rollno;
        $application->name = $request->name;
        $application->year = $request->year;
        $application->branch = $request->branch;
        $application->marks = $request->marks;
        $application->accm_for = $request->accm_for;

        $application->hostel_pref1 = $request->hostel_pref1;
        $application->hostel_pref2 = $request->hostel_pref2;
        $application->hostel_pref3 = $request->hostel_pref3;
        $application->hostel_pref4 = $request->hostel_pref4;

        $application->room_pref1 = $request->pref1;
        $application->room_pref2 = $request->pref2;
        $application->room_pref3 = $request->pref3;
        $application->room_pref4 = $request->pref4;

        $application->floor_pref1 = $request->floor_pref1;
        $application->floor_pref2 = $request->floor_pref2;
        $application->floor_pref3 = $request->floor_pref3;
        $application->floor_pref4 = $request->floor_pref4;

        $application->mate1 = $request->mate1;
        $application->mate2 = $request->mate2;
        $application->mate3 = $request->mate3;
        $application->save();

        $result = boyshostel::where('regno',Auth::user()->regno)->first();
        $application = application::where('regno',Auth::user()->regno)->first();
        $roommates = boyshostel::where([['roomno',$application->roomno],['hostel_id',$application->hostel_id]])->get();

        return view('user/dashboard', compact('result','application','roommates'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boyshostels = boyshostel::where('year',$id)->get();
        foreach ($boyshostels as $boyshostel) {
            $boyshostel->status = '0';
            $boyshostel->regno = NULL;
            $boyshostel->name = NULL;
            $boyshostel->year = NULL;
            $boyshostel->branch = NULL;
            $boyshostel->save();
        }
        return back();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applications = application::where('accm_for',$id)->get();
        foreach ($applications as $form) {
            $form->meritin = '0';
            $form->status = '0';
            $form->save();
        }
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
        return 'yes';    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = application::where('id',$id)->first();
        $application->delete();

        return back();
    }

}
