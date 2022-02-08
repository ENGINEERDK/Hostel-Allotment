<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use redirect;
use App\hostels;
use App\year;
use App\Userdetail;
use App\Studentmerit;
use App\application;
use App\boyshostel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function form(Request $request)
    {	
        $application = application::where('regno',Auth::user()->regno)->first();
        if(!is_null($application))
        {
            $result = boyshostel::where('regno',Auth::user()->regno)->first();
            $roommates = boyshostel::where([['roomno',$application->roomno],['hostel_id',$application->hostel_id]])->get();
            return view('user/dashboard', compact('result','application','roommates'));
        }
        
    	$this->validate($request,[
    		'Checkbox' => 'required',
            'gender'=>'required',
            'year' => 'required',
            ]);
        //passing Accomodation year to form
        $accomodationfor = year::where('year',$request->year)->first();
        //$accomodationfor = $accomodationfor->year;
        //dd($accomodationfor);

    	if($request->gender == '2' || Userdetail::where( [['regno',Auth::user()->regno],['sex',"FEMALE"]])->count())
    	{
    		Session::flash('message', "Currently Portal is not available for Girls Hostel Allotment at AIT. ");
			return Redirect()->back();
    	}
    	else if(!hostels::where('allotedto',$request->year)->exists())
		{
			Session::flash('message', "Accomodation for selected year is currently not Available or Not Provided by AIT. ");
			return Redirect()->back();
		}
	

    	$hostels= hostels::where('allotedto', $request->year)->get();
        //dd(count($hostels));
        //$hostels = hostels::whereIn('hostel_id',[$allotedhostels->hostel1, $allotedhostels->hostel2, $allotedhostels->hostel3])->get();

        $user = Userdetail::where('regno',Auth::user()->regno)->first();
        $usermerit = Studentmerit::where('regno',Auth::user()->regno)->first();
        if(!$usermerit)
            return back()->with('message','Your Merit Rocord not Found. Kindly Contact Administrator.');

        //return $hostels and user data;
        return view('user/Application_Form', compact('hostels','user','usermerit','accomodationfor'));
    }

    public function applicationpdf($regno)
    {   
        if(Auth::user()->regno != $regno)
            return back()->with('message','Sorry not allowed here atleast. Keep calm.');
        $data['application'] =  application::where('regno', $regno)->first();
        $data['meritdata'] =  Studentmerit::where('regno', $regno)->first();
        $pdf = PDF::loadView('user/applicationpdf', $data);
  
        return $pdf->stream('Application_Form.pdf');
    }
}
