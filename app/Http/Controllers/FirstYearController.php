<?php

namespace App\Http\Controllers;

use DB;
use App\boyshostel;
use App\Capacity;
use App\application;
use App\hostels;
use App\studenthostel;
use App\hostelcategory;
use Illuminate\Http\Request;

class FirstYearController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1st year warden');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $id ='1';   //year id
        //hostel alloted year wise 
        $hostels = hostels::where('allotedto',$id)->get();
        if(!count($hostels))
        {
            $msg="Admin has not alloted Hostel for Second Year Student yet.Kindly contact Super-Admin.";
            return view('admin/error',compact('msg'));
        }

        $hostelalloted = array();
        foreach ($hostels as $hostel) {
            $hostelalloted[] = $hostel->hostel_id;
        }
        //dd($hostelalloted);
        
        //total beds
        $beds = boyshostel::whereIn('hostel_id', $hostelalloted )->count();
        //dd($beds);
        //$hostelname = hostels::whereIn('hostel_id', $hostel->hostel_id)->get();
        //dd($hostelname);

        //room alloted
        $alloted = boyshostel::whereIn('hostel_id', $hostelalloted)->whereNotNull('regno')->where('year',$id)->orderBy('hostel_id','ASC')->orderBy('floor','ASC')->orderBy('roomno','asc')->orderBy('bedno','ASC')->paginate(150);
        //dd(count($allot));

        //getting no of hostels seats
        $allotedhostels = array();
        foreach ($hostels as $hostel) {
            $allotedhostels[] = $hostel->hostel_id;
        }

        $totalcapacity = boyshostel::whereIn('hostel_id',$hostelalloted)->count();

        $itapplications = application::where([['accm_for',$id],['branch','3']])->count();
        $mechapplications = application::where([['accm_for',$id],['branch','4']])->count();
        $entc1applications = application::where([['accm_for',$id],['branch','1']])->count();
        $entc2applications = application::where([['accm_for',$id],['branch','2']])->count();
        $comp1applications = application::where([['accm_for',$id],['branch','5']])->count();
        $comp2applications = application::where([['accm_for',$id],['branch','6']])->count();

        $totalstrength = $itapplications + $mechapplications + $entc1applications + $entc2applications + $comp1applications + $comp2applications;

        //alloting Rooms In proportion of Strength 
        //special algorith for allocating in whole Numbers
        if($totalstrength==0){
            $it_allot=0;
            $mech_allot=0;
            $entc1_allot=0;
            $comp1_allot=0;
            $entc2_allot=0;
            $comp2_allot=0;
        }
        else{
            $it_allot = ($itapplications * $totalcapacity)/$totalstrength;
            $it_allot = round($it_allot);

            $totalstrength = $totalstrength - $itapplications;
            $totalcapacity = $totalcapacity - $it_allot;
            $mech_allot = ($mechapplications * $totalcapacity)/$totalstrength;
            $mech_allot = round($mech_allot);

            $totalstrength = $totalstrength - $mechapplications;
            $totalcapacity = $totalcapacity - $mech_allot;
            $comp1_allot = ($comp1applications * $totalcapacity)/$totalstrength;
            $comp1_allot = round($comp1_allot);

            $totalstrength = $totalstrength - $comp1applications;
            $totalcapacity = $totalcapacity - $comp1_allot;
            $comp2_allot = ($comp2applications * $totalcapacity)/$totalstrength;
            $comp2_allot = round($comp2_allot);

            $totalstrength = $totalstrength - $comp2applications;
            $totalcapacity = $totalcapacity - $comp2_allot;
            $entc1_allot = ($entc1applications * $totalcapacity)/$totalstrength;
            $entc1_allot = round($entc1_allot);

            if($id==4)  
            {
                $totalstrength = $totalstrength - $entc1applications;
                $totalcapacity = $totalcapacity - $entc1_allot;
                $entc2_allot = ($entc2applications * $totalcapacity)/$totalstrength;
                $entc2_allot = round($entc2_allot); 
            }
            else
                $entc2_allot = 0;
             
        }
        return view('admin/result',compact('id','beds','hostels','alloted','it_allot','mech_allot','entc1_allot','comp1_allot','entc2_allot','comp2_allot'));
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
        //
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
        //
    }
}
