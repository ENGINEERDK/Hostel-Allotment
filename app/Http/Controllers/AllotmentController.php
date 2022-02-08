<?php

namespace App\Http\Controllers;
use DB;
use Session;
use redirect;
use App\boyshostel;
use App\application;
use App\hostels;
use App\Capacity;
use App\studenthostel;
use App\hostelcategory;
use Illuminate\Http\Request;

use App\Exports\AllotmentExport;
use Maatwebsite\Excel\Facades\Excel;

class AllotmentController extends Controller
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
        $hostels = hostels::get();
        return view('admin/dashboard',compact('hostels','totalhostel'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'hostel_id'=>'required',
            'floor'=>'required',
            'roomno' => 'required',
            'roomtype' => 'required',
            ]);

        if(count(boyshostel::where([['hostel_id',$request->hostel_id],['roomno',$request->roomno]])->get()))
        {
            Session::flash('message', "Room No. already Exist. To Modify First Delete existing. ");
            return back();
        }
        $bed='1';

        switch($request->roomtype)
        {
            case 4:
            $boyshostel= new boyshostel;
            $boyshostel->hostel_id = $request->hostel_id;
            $boyshostel->floor = $request->floor;
            $boyshostel->roomno = $request->roomno;
            $boyshostel->roomtype = $request->roomtype;
            $boyshostel->bedno = $bed++;
            $boyshostel->save();

            case 3:
            $boyshostel= new boyshostel;
            $boyshostel->hostel_id = $request->hostel_id;
            $boyshostel->floor = $request->floor;
            $boyshostel->roomno = $request->roomno;
            $boyshostel->roomtype = $request->roomtype;
            $boyshostel->bedno = $bed++;
            $boyshostel->save();

            case 2:
            $boyshostel= new boyshostel;
            $boyshostel->hostel_id = $request->hostel_id;
            $boyshostel->floor = $request->floor;
            $boyshostel->roomno = $request->roomno;
            $boyshostel->roomtype = $request->roomtype;
            $boyshostel->bedno = $bed++;
            $boyshostel->save();

            $boyshostel= new boyshostel;
            $boyshostel->hostel_id = $request->hostel_id;
            $boyshostel->floor = $request->floor;
            $boyshostel->roomno = $request->roomno;
            $boyshostel->roomtype = $request->roomtype;
            $boyshostel->bedno = $bed++;
            $boyshostel->save();

            break;

            case 1:
            $boyshostel= new boyshostel;
            $boyshostel->hostel_id = $request->hostel_id;
            $boyshostel->floor = $request->floor;
            $boyshostel->roomno = $request->roomno;
            $boyshostel->roomtype = $request->roomtype;
            $boyshostel->bedno = $bed++;
            $boyshostel->reserved = $request->allotonly;
            $boyshostel->save();

        }

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
        $applications = application::where('accm_for',$id)->orderBy('regno')->paginate(150);
        return view('admin/hostelapplication',compact('id','applications'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //hostel alloted year wise 
        $hostel = studenthostel::where('year',$id)->orderBy('year','ASC')->first();
        if($hostel == NULL)
        {
            $msg="Kindly Shedule the hostel first then visit this Page";
            return view('admin/error',compact('msg'));
        }
        $hostelname = hostels::whereIn('hostel_id', [$hostel->hostel1, $hostel->hostel2, $hostel->hostel3])->get();
        //total beds
        $beds = boyshostel::whereIn('hostel_id', [$hostel->hostel1, $hostel->hostel2, $hostel->hostel3])->count();

        //room alloted
        $allot = boyshostel::whereIn('hostel_id', [$hostel->hostel1, $hostel->hostel2, $hostel->hostel3])->whereNotNull('regno')->where('year',($id-'1'))->orderBy('hostel_id','ASC')->orderBy('hostel_id','ASC')->orderBy('floor','ASC')->orderBy('roomno','asc')->orderBy('bedno','ASC')->get();

        return view('admin/result',compact('id','beds','hostels','hostelname','allot'));
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
        $rooms = boyshostel::where('roomno',$id)->get();

        foreach ($rooms as $room) {
            $room->delete();
        }
        return back();
    }

    public function result()
    {
        $beds= boyshostel::all();
        $beds= count($beds);
        $boyshostel = boyshostel::orderBy('roomno','ASC')->whereNotNull('regno')->get();
        return view('admin/hostelapplications',compact('boyshostel','beds'));

    }

    public function allotmentexcel($year)
    {
        return (new AllotmentExport)->forYear($year)->download('HostelAllotmentResult.xlsx');

    }


    public function selectmerit($year){

        $hostels = hostels::where('allotedto',$year)->get();

        $allotedhostels = array();
        foreach ($hostels as $hostel) {
            $allotedhostels[] = $hostel->hostel_id;
        }

        $totalcapacity = boyshostel::whereIn('hostel_id',$allotedhostels)->count();

        $itapplications = application::where([['accm_for',$year],['branch','3']])->count();
        $mechapplications = application::where([['accm_for',$year],['branch','2']])->count();
        $entcapplications = application::where([['accm_for',$year],['branch','1']])->count();
        $compapplications = application::where([['accm_for',$year],['branch','4']])->count();

        $totalstrength = $itapplications + $mechapplications + $entcapplications + $compapplications;

        //alloting Rooms In proportion of Strength 
        //special algorith for allocating in whole Numbers
        if($totalstrength==0){
            $it_allot=0;
            $mech_allot=0;
            $entc_allot=0;
            $comp_allot=0;
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
            $entc_allot = ($entcapplications * $totalcapacity)/$totalstrength;
            $entc_allot = round($entc_allot);

            $comp_allot = $totalcapacity = $totalcapacity - $entc_allot; // left all rooms assigned
        }// $entc_allot = ($students->entc * $totalcapacity)/$totalstrength;
        // $comp_allot = ($students->comp * $totalcapacity)/$totalstrength;

        //setting merit-in branch wise
        $it_students = application::where([['accm_for',$year],['branch',3]])->orderBy('marks','DESC')->take($it_allot)->get();
        foreach ($it_students as $it_student) {
            $it_student->meritin = '1';
            $it_student->save();
        }

        $mech_students = application::where([['accm_for',$year],['branch',4]])->orderBy('marks','DESC')->take($mech_allot)->get();
        foreach ($mech_students as $mech_student) {
            $mech_student->meritin = '1';
            $mech_student->save();
        }

        $entc_students = application::where([['accm_for',$year],['branch',1]])->orderBy('marks','DESC')->take($entc_allot)->get();
        foreach ($entc_students as $entc_student) {
            $entc_student->meritin = '1';
            $entc_student->save();
        }

        $comp_students = application::where([['accm_for',$year],['branch',2]])->orderBy('marks','DESC')->take($comp_allot)->get();
        foreach ($comp_students as $comp_student) {
            $comp_student->meritin = '1';
            $comp_student->save();
        }

        return $allotedhostels;
        //return $entc_students;
        //return ($it_allot+$mech_allot+$entc_allot+$comp_allot);
    }

    public function allotment($year){

    // public function selectmerit($year){   now now defined explicitely
        $hostels = hostels::where('allotedto',$year)->get();

        $allotedhostels = array();
        foreach ($hostels as $hostel) {
            $allotedhostels[] = $hostel->hostel_id;
        }

        $totalcapacity = boyshostel::whereIn('hostel_id',$allotedhostels)->count();

        $itapplications = application::where([['accm_for',$year],['branch','3']])->count();
        $mechapplications = application::where([['accm_for',$year],['branch','4']])->count();
        $entc1applications = application::where([['accm_for',$year],['branch','1']])->count();
        $entc2applications = application::where([['accm_for',$year],['branch','2']])->count();
        $comp1applications = application::where([['accm_for',$year],['branch','5']])->count();
        $comp2applications = application::where([['accm_for',$year],['branch','6']])->count();

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

            if($year==4)  
            {
                $totalstrength = $totalstrength - $entc1applications;
                $totalcapacity = $totalcapacity - $entc1_allot;
                $entc2_allot = ($entc2applications * $totalcapacity)/$totalstrength;
                $entc2_allot = round($entc2_allot); 
            }
            else
                $entc2_allot = 0;
             
        }// $entc_allot = ($students->entc * $totalcapacity)/$totalstrength;
        // $comp_allot = ($students->comp * $totalcapacity)/$totalstrength;

        //setting merit-in branch wise
        $it_students = application::where([['accm_for',$year],['branch',3]])->orderBy('marks','DESC')->take($it_allot)->get();
        foreach ($it_students as $it_student) {
            $it_student->meritin = '1';
            $it_student->save();
        }

        $mech_students = application::where([['accm_for',$year],['branch',4]])->orderBy('marks','DESC')->take($mech_allot)->get();
        foreach ($mech_students as $mech_student) {
            $mech_student->meritin = '1';
            $mech_student->save();
        }

        $comp1_students = application::where([['accm_for',$year],['branch',5]])->orderBy('marks','DESC')->take($comp1_allot)->get();
        foreach ($comp1_students as $comp1_student) {
            $comp1_student->meritin = '1';
            $comp1_student->save();
        }

        $comp2_students = application::where([['accm_for',$year],['branch',6]])->orderBy('marks','DESC')->take($comp2_allot)->get();
        foreach ($comp2_students as $comp2_student) {
            $comp2_student->meritin = '1';
            $comp2_student->save();
        }


        $entc1_students = application::where([['accm_for',$year],['branch',1]])->orderBy('marks','DESC')->take($entc1_allot)->get();
        foreach ($entc1_students as $entc1_student) {
            $entc1_student->meritin = '1';
            $entc1_student->save();
        }

        if($year == '4')
        {
            $entc2_students = application::where([['accm_for',$year],['branch',2]])->orderBy('marks','DESC')->take($entc2_allot)->get();
            foreach ($entc2_students as $entc2_student) {
                $entc2_student->meritin = '1';
                $entc2_student->save();
        }
        }

        

                                // 1st Round of Hostel Allotment

    //special handling of doublet rooms, when all the doublets are full. choices of doublet bed 2 will be taken.
    $doubletrooms = boyshostel::whereIn('hostel_id',$allotedhostels)->where([['roomtype','2'],['bedno','1']])->count();
    $tripletrooms = boyshostel::whereIn('hostel_id',$allotedhostels)->where([['roomtype','3'],['bedno','1']])->count();
    $doublets=1;  $triplets=1;      // this will be incremented each time a doublet alloted.
    // return $doubletrooms;
    //Form Checking starts here.

    $index = application::where([['accm_for',$year],['meritin','1'],['status','0']])->orderBy('marks','DESC')->pluck('id');

    $entc1_appliorder=array();
    $entc2_appliorder=array();
    $it_appliorder=array();
    $mech_appliorder=array();
    $comp1_appliorder=array();
    $comp2_appliorder=array();
    $branch='1';
    $searchflag='0';
    for ($k = 0 ; $k < count($index); $k++){
                //Taking highest scorer application from each branch one bye one who are not alloted room yet. 
        
        while(1) 
        {
            switch ($branch) {
                case '1':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$entc1_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $entc1_appliorder[] = $application->id;
                    break;
                case '2':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$entc2_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $entc2_appliorder[] = $application->id;
                    break;
                case '3':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$it_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $it_appliorder[] = $application->id;
                    break;
                case '4':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$mech_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $mech_appliorder[] = $application->id;
                    break;
                case '5':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$comp1_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $comp1_appliorder[] = $application->id;
                    break;
                case '6':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$comp2_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $comp2_appliorder[] = $application->id;
                    break;
                }
                if($branch=='7')
                    $branch='1';
                if($searchflag=='7')
                    break;        // No application left having merit ==1 and status == 0;

                if(!is_null($application))
                {   
                    $searchflag='0';
                    break;              // break out from loop. A application found.
                }
            }

            if($searchflag=='7')
                    break;        // come out of Round 1st allotment if no application left from any branch

            if(!is_null($application))
            {
            echo $application->regno;
            echo " ";
            $roompref=array($application->room_pref1,$application->room_pref2,$application->room_pref3,$application->room_pref4);
            $floorpref=array($application->floor_pref1,$application->floor_pref2,$application->floor_pref3,$application->floor_pref4);
            $hostelpref = array($application->hostel_pref1,$application->hostel_pref2, $application->hostel_pref3,$application->hostel_pref4);
            $hostelpref=array_filter($hostelpref,'strlen'); //removing NULL
            //return $hostelpref;
            $roomkey='0';
            $floorkey='0';
            $hostelkey='0';
            while( $roomkey <'4'){

            //Doublets special algo.if doublets bed1 is filled check for bed2 in case of doublet.
            $bednumber=array();
            $bednumber[]='1';
            
            if( ($roompref[$roomkey] == '2') && ($doublets > $doubletrooms)) {
                    $bednumber=array();
                    $bednumber[]='2';
                }
            if( ($roompref[$roomkey] == '3') && ($triplets > $tripletrooms)) {
                    $bednumber=array();
                    $bednumber[]='2';
                    $bednumber[]='3';
                }
            $owner = boyshostel::where([
                                    ['status', '=', '0'], 
                                    ['hostel_id', '=', $hostelpref[$hostelkey]],
                                    ['roomtype', '=', $roompref[$roomkey]],
                                    ['floor', '=', $floorpref[$floorkey]],])
                            ->whereIn('reserved',[ '0' , $application->branch])
                            ->whereIn('bedno',$bednumber)
                            ->first();
            echo $hostelpref[$hostelkey];
            echo $roompref[$roomkey];
            echo $floorpref[$floorkey];
            echo " ";
            
            if( !is_null($owner) ){
                if(($roompref[$roomkey]) == '3'){
                    $triplets++;
                }
                if(($roompref[$roomkey]) == '2'){
                    $doublets++;
                }
                break;
            }

            if($floorkey == '3')
            {
                $hostelkey++;
                if($hostelkey ==sizeof($hostelpref))
                {
                    $roomkey++;
                    $floorkey='0';
                    $hostelkey='0';
                }
                else{
                    $floorkey='0';
                }
            }
            else{
            $floorkey++;
            }
        }
        echo "main seach ends";
        if( !is_null($owner)) {
            echo "main entry";

            $hostel = $owner;
            $owner->regno = $application->regno;
            $owner->name = $application->name;
            $owner->year = $application->accm_for;
            $owner->branch = $application->branch;
            $owner->status = '1';
            $owner->save();

            echo $application->name;
            $set= application::find($application->regno);
            $set->status = '1';
            $set->save();

            //return 'allotment succ';
            if($hostel->roomtype == '2')
            {
                $bedno=2;
                $roommate= application::where(([['accm_for',$year],['status', '=', '0'],['meritin','=','1']]))->whereIn('regno', [$application->mate1, $application->mate2, $application->mate3])->get();
                if( $roommate != NULL)
                {
                    foreach($roommate as $partener) {
                         if(($partener->mate1 == $application->regno) || ($partener->mate2 == $application->regno) || ($partener->mate3 == $application->regno))
                            {
                        $bed2 = boyshostel::whereIn('hostel_id',$allotedhostels)->where([
                                            ['roomno', '=', $hostel->roomno],
                                            ['bedno', '=', $bedno],
                                            ['status','=','0'],
                                        ])->first();
                                    if(!is_null($bed2))
                                    { 
                                        $room = boyshostel::find($bed2->id);
                                        $room->regno = $partener->regno;
                                        $room->name = $partener->name;
                                        $room->year = $partener->accm_for;
                                        $room->branch = $partener->branch;
                                        $room->status = '1';
                                        $room->save();
                                        echo "side entry";
                                        echo $partener->name;


                                        $roommate1 = application::find($partener->regno);
                                        $roommate1->status = '1';
                                        $roommate1->save();
                                        break;
                                    }
                                }
                            }
                        }
            }

            if($hostel->roomtype == '3')
            {
                $roommates =application::whereIn('regno',[$application->mate1,$application->mate2,$application->mate3])->where(([['accm_for',$year],['status', '0'],['meritin','1']]))->orderBy('marks','DESC')->get();
                foreach ($roommates as $roommate) {
                    $bedno='3';
                    $placeinroom = boyshostel::where([['hostel_id',$hostel->hostel_id],['roomno',$hostel->roomno],['status','0']])->orderBy('bedno','DESC')->first();
                    if(!is_null($placeinroom)){
                        $placeinroom->name = $roommate->name;
                        $placeinroom->regno = $roommate->regno;
                        $placeinroom->year = $roommate->accm_for;
                        $placeinroom->branch = $roommate->branch;
                        $placeinroom->status = '1';
                        $placeinroom->save();
                                            echo "side entry";
                                            echo $roommate->name;
                        $roommate->status = '1';
                        $roommate->save();
                        $bedno--;
                        }
                }
            }
            if($hostel->roomtype == '4')
            {
                $roommates =application::whereIn('regno',[$application->mate1,$application->mate2,$application->mate3])->where(([['accm_for',$year],['status', '0'],['meritin','1']]))->orderBy('marks','DESC')->get();
                foreach ($roommates as $roommate) {
                    $bedno='4';
                    $placeinroom = boyshostel::where([['hostel_id',$hostel->hostel_id],['roomno',$hostel->roomno],['status','0']])->orderBy('bedno','DESC')->first();
                    if(!is_null($placeinroom)){
                        $placeinroom->name = $roommate->name;
                        $placeinroom->regno = $roommate->regno;
                        $placeinroom->year = $roommate->accm_for;
                        $placeinroom->branch = $roommate->branch;
                        $placeinroom->status = '1';
                        $placeinroom->save();
                                            echo "side entry";
                                            echo $roommate->name;
                        $roommate->status = '1';
                        $roommate->save();
                        $bedno--;
                        }
                }
            }
        } //end of room-mate allocation.
      }//end of application checking
    }//application foreach close
    echo "1st round end here.";


                                        // 2nd round of allotment
    $index = application::where([['accm_for',$year],['meritin','1'],['status','0']])->orderBy('marks','DESC')->pluck('id');

    $entc1_appliorder=array();
    $entc2_appliorder=array();
    $it_appliorder=array();
    $mech_appliorder=array();
    $comp1_appliorder=array();
    $comp2_appliorder=array();
    $branch='1';
    $searchflag='0';
    for ($k = 0 ; $k < count($index); $k++){

        while(1) 
        {
            switch ($branch) {
                case '1':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$entc1_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $entc1_appliorder[] = $application->id;
                    break;
                case '2':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$entc2_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $entc2_appliorder[] = $application->id;
                    break;
                case '3':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$it_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $it_appliorder[] = $application->id;
                    break;
                case '4':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$mech_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $mech_appliorder[] = $application->id;
                    break;
                case '5':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$comp1_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $comp1_appliorder[] = $application->id;
                    break;
                case '6':
                    $application = application::whereIn('id',$index)->where([['branch',$branch],['status','0']])->whereNotIn('id',$comp2_appliorder)->orderBy('marks','DESC')->first();
                    $branch++; $searchflag++;
                    if(!is_null($application))
                        $comp2_appliorder[] = $application->id;
                    break;
                }
                if($branch=='7')
                    $branch='1';
                if($searchflag=='7')
                    break;        // No application left having merit ==1 and status == 0;

                if(!is_null($application))
                    break;              // break out from loop. A application found.
            }

            if($searchflag=='7')
                    break;        // come out if no application left from any branch

            if(!is_null($application))
            {
            echo "down enter";
            echo $application->name;
            $applicationmates=array($application->mate1,$application->mate2,$application->mate3);
            $applicationmates=array_filter($applicationmates,'strlen');

                $roompref=array($application->room_pref1,$application->room_pref2,$application->room_pref3,$application->room_pref4);
                $floorpref=array($application->floor_pref1,$application->floor_pref2,$application->floor_pref3,$application->floor_pref4);
                $hostelpref = array($application->hostel_pref1,$application->hostel_pref2, $application->hostel_pref3,$application->hostel_pref4);
                $hostelpref=array_filter($hostelpref,'strlen'); //removing NULL
                //return $hostelpref;
                $roomkey='0';
                $floorkey='0';
                $hostelkey='0';
                while( $roomkey <'4'){
                $owner = boyshostel::where([
                                        ['status', '=', '0'], 
                                        ['hostel_id', '=', $hostelpref[$hostelkey]],
                                        ['roomtype', '=', $roompref[$roomkey]],
                                        ['floor', '=', $floorpref[$floorkey]],])
                                ->whereIn('reserved',[ '0' , $application->branch])->orderBy('bedno','DESC')->first();
                    echo $hostelpref[$hostelkey];
                    echo $roompref[$roomkey];
                    echo $floorpref[$floorkey];
                    echo " ";
                    
                    if( !is_null($owner) ){
                        break;
                    }

                    if($floorkey == '3')
                    {
                        $hostelkey++;
                        if($hostelkey ==sizeof($hostelpref))
                        {
                            $roomkey++;
                            $floorkey='0';
                            $hostelkey='0';
                        }
                        else{
                            $floorkey='0';
                        }
                    }
                    else{
                    $floorkey++;
                    }
                }
                if( !is_null($owner)) {
                    echo "2nd round entry";

                    $applicationroom = $owner;
                    $owner->regno = $application->regno;
                    $owner->name = $application->name;
                    $owner->year = $application->accm_for;
                    $owner->branch = $application->branch;
                    $owner->status = '1';
                    $owner->save();

                    echo $application->name;
                    $set= application::find($application->regno);
                    $set->status = '1';
                    $set->save();

                    if((!is_null($applicationmates)) && ($applicationroom->roomtype >'2'))
                        {
                           $prefroommates = application::whereIn('regno',$applicationmates)->where(([['accm_for',$year],['status', '0'],['meritin','1']]))->orderBy('marks','DESC')->get();
                           foreach ($prefroommates as $prefroommate) {
                               if(($prefroommate->mate1 == $application->regno) || ($prefroommate->mate2 == $application->regno) || ($prefroommate->mate3 == $application->regno))
                                    {
                                    $emptyroom = boyshostel::where([['hostel_id',$applicationroom->hostel_id],['roomno',$application->roomno],['status','0']])->first();
                                    if( count($emptyroom) )
                                        {
                                        $emptyroom->regno = $applicationmates[0]->regno;
                                        $emptyroom->name = $applicationmates[0]->name;
                                        $emptyroom->year = $applicationmates[0]->accm_for;
                                        $emptyroom->branch = $applicationmates[0]->branch;
                                        $emptyroom->status = '1';
                                        $emptyroom->save();

                                        echo $applicationmates[0]->name;
                                        $set= application::find($applicationmates[0]->regno);
                                        $set->status = '1';
                                        $set->save();
                                    }
                               }
                            
                           }
                       } //if roommate found
                    }
                }
            } //end of single assign.
            echo "2nd round end here";


                        //3rd Round of allotment for merit not in Students

        $hostels = hostels::where('allotedto',$year)->get();
        $allotedhostels = array();
        foreach ($hostels as $hostel) {
            $allotedhostels[] = $hostel->hostel_id;
        }

        $applications = application::orderBy('marks','DESC')->where([['accm_for',$year],['status','=','0']])->get();
        foreach ($applications as $application) {
            $vacantroom = boyshostel::whereIn('hostel_id',[$application->hostel_pref1,$application->hostel_pref2,$application->hostel_pref3,$application->hostel_pref4])->where('status','0')->first();
            if(!is_null($vacantroom))
            {
                $vacantroom->regno = $application->regno;
                $vacantroom->name = $application->name;
                $vacantroom->year = $application->accm_for;
                $vacantroom->branch = $application->branch;
                $vacantroom->status = '1';
                $vacantroom->save();
                                        echo "bachi side entry";
                                        echo $application->name;

                $set= application::find($application->regno);
                $set->status = '1';
                $set->save();
            }
        }
        echo "3rd round end here";
        

        $id = $year;
        //total beds
        $hostels = hostels::where('allotedto',$year)->get();

        $hostelalloted = array();
        foreach ($hostels as $hostel) {
            $hostelalloted[] = $hostel->hostel_id;
        }
        $beds = boyshostel::whereIn('hostel_id', $hostelalloted )->count();

        $alloted = boyshostel::whereNotNull('regno')->where([['status', '1'],['year',$year]])->orderBy('regno','DESC')->paginate(150);
        Session::flash('message', "Allotment Successful.");
        return view('admin/result',compact('id','beds','hostels','alloted','it_allot','mech_allot','entc1_allot','comp1_allot','entc2_allot','comp2_allot'));
    }


                                    //OLD ALLOTMENT ALGORITH JUST FOR FUTURE REFERENCE
    public function allotmentalgo($year){

    $this->selectmerit($year);
    $id=$year;
    return $id;
    //To set the hostel names on Page
    $hostelnames = studenthostel::where('year',$id)->orderBy('year','ASC')->first();
    $hostelname = hostels::whereIn('hostel_id', [$hostelnames->hostel1, $hostelnames->hostel2, $hostelnames->hostel3])->get();

    //Alotment Algorithm

    //beds for each category each year
    $hostels = studenthostel::where('year',$year)->first();

    //hostel category wise allotment
    $categories = hostelcategory::all();
    foreach ($categories as $category) {
        //allotment starts here
        $beds = DB::table('boyshostels')
                    ->join('hostels','hostels.hostel_id','=','boyshostels.hostel_id')
                    ->where('hostels.category',$category->category)
                    ->whereIn('hostels.hostel_id', [$hostels->hostel1, $hostels->hostel2, $hostels->hostel3])
                    ->count();

        //hostel application each category
        $application = application::where([['accm_for',$year],['status','0']])->orderBy('marks','desc')->get();
        $merit='0';
        foreach ($application as $applicant) {
            if($merit<$beds)
            {
                $in =application::find($applicant->regno);
                $in->meritin = '1';
                $in->save();

                $merit++;
            }
            else{
                break;
            }
        }

        $application = application::where([['accm_for',$year],['meritin','1'],['status','0']])->orderBy('marks','desc')->get(); 
        foreach ($application as $form) {

            //MECHANISM TO CHECK IF STUDENT PREFERRED HOSTEL IS PRESENT
            $hostelmatch = hostels::where('category',$category->category)->whereIn('hostel_id', [$form->hostel_pref1,$form->hostel_pref2, $form->hostel_pref3])->count();
            if($hostelmatch >'0'){

                $roompref=array($form->room_pref1,$form->room_pref2,$form->room_pref3,$form->room_pref4);
                $floorpref=array($form->floor_pref1,$form->floor_pref2,$form->floor_pref3,$form->floor_pref4);
                $hostelpref = hostels::where('category',$category->category)->whereIn('hostel_id', [$form->hostel_pref1,$form->hostel_pref2, $form->hostel_pref3])->pluck('hostel_id');

                //old hostel allotment
                //$hostelpref=array($form->hostel_pref1,$form->hostel_pref2,$form->hostel_pref3);

                $roomkey='0';
                $floorkey='0';
                $hostelkey='0';
                while( $roomkey <'4')
                {
                    $owner = boyshostel::where([
                                            ['status', '=', '0'],
                                            ['bedno', '=', '1'],
                                            ['hostel_id', '=', $hostelpref[$hostelkey]],
                                            ['roomtype', '=', $roompref[$roomkey]],
                                            ['floor', '=', $floorpref[$floorkey]],])
                                    ->whereIn('reserved',[ 0 , $form->branch])
                                    ->count();
                    echo $hostelpref[$hostelkey];
                    echo $roompref[$roomkey];
                    echo $floorpref[$floorkey];
                    echo " ";
                    if( $owner > '0'){
                        echo " CHOICE MATCHED ";
                        break;
                    }
                    if($floorkey == '3')
                    {
                        $hostelkey++;
                        if($hostelkey ==sizeof($hostelpref))
                        {
                            $roomkey++;
                            $floorkey='0';
                            $hostelkey='0';
                        }
                        else{
                            $floorkey='0';
                        }
                    }
                    else{
                    $floorkey++;
                    }
                }
                if( $owner > '0')
                 {
                    $hostel = boyshostel::where([
                                            ['status', '=', '0'],
                                            ['bedno', '=', '1'],
                                            ['roomtype', '=', $roompref[$roomkey]],
                                            ['floor', '=', $floorpref[$floorkey]],
                                            ['hostel_id', '=', $hostelpref[$hostelkey]],
                                        ])->first();
                    echo "main entry";
                    $room = $hostel;
                    $room->regno = $form->regno;
                    $room->name = $form->name;
                    $room->year = $form->year;
                    $room->branch = $form->branch;
                    $room->status = '1';
                    $room->save();

                    $set= application::find($form->regno);
                    $set->status = '1';
                    $set->save();

                    if($hostel->roomtype == '2')
                    {
                        $roommate= application::where('meritin','=','1')->where('status', '=', '0')->whereIn('regno', [$form->mate1, $form->mate2, $form->mate3])->get();
                        if( $roommate != NULL)
                        {
                            foreach ($roommate as $partener) {
                                 if(($partener->mate1 == $form->regno) || ($partener->mate2 == $form->regno) || ($partener->mate3 == $form->regno))
                                    {
                                echo "side entry1";
                                $bed2= boyshostel::where([
                                                    ['roomno', '=', $hostel->roomno],
                                                    ['bedno', '=', '2'],
                                                ])->first();

                                                $room = boyshostel::find($bed2->id);
                                                $room->regno = $partener->regno;
                                                $room->name = $partener->name;
                                                $room->year = $partener->year;
                                                $room->branch = $partener->branch;
                                                $room->status = '1';
                                                $room->save();

                                                $roommate1 = application::find($partener->regno);
                                                $roommate1->status = '1';
                                                $roommate1->save();
                                                echo $roommate1;
                                                break;
                                        }
                                    }
                                }
                    }

                    if($hostel->roomtype == '3')
                    {
                        $count =application::whereIn('regno',[$form->mate1,$form->mate2,$form->mate3])->where(([['status', '=', '0'],['meritin','=','1']]))->count();

                        while ($count > '0') {
                            $bedno='2';
                            $roommate = application::whereIn('regno',[$form->mate1,$form->mate2,$form->mate3])->where(([['status', '=', '0'],['meritin','=','1']]))->orderBy('marks','desc')->get();
                            $bed= boyshostel::where([
                                                    ['roomno', '=', $hostel->roomno],
                                                    ['bedno', '=', $bedno],
                                                ])->first();

                                    $room = boyshostel::find($bed->id);
                                    $room->regno = $roommate->regno;
                                    $room->name = $roommate->name;
                                    $room->year = $roommate->year;
                                    $room->branch = $roommate->branch;
                                    $room->status = '1';
                                    $room->save();

                                    $roommate->status = '1';
                                    $roommate->save();
                                if($bedno=='3')
                                    break;
                                else
                                    $bedno++;
                        }
                    }
                    if($hostel->roomtype == '4')
                    {
                        $count =application::whereIn('regno',[$form->mate1,$form->mate2,$form->mate3])->where(([['status', '=', '0'],['meritin','=','1']]))->count();

                        while ($count > '0') {
                            $bedno='2';
                            $roommate = application::whereIn('regno',[$form->mate1,$form->mate2,$form->mate3])->where(([['status', '=', '0'],['meritin','=','1']]))->orderBy('marks','ASC')->get();
                            $bed= boyshostel::where([
                                                    ['roomno', '=', $hostel->roomno],
                                                    ['bedno', '=', $bedno],
                                                ])->first();

                                    $room = boyshostel::find($bed->id);
                                    $room->regno = $roommate->regno;
                                    $room->name = $roommate->name;
                                    $room->year = $roommate->year;
                                    $room->branch = $roommate->branch;
                                    $room->status = '1';
                                    $room->save();
                                    $roommate->status = '1';
                                    $roommate->save();
                                if($bedno=='4')
                                    break;
                                else
                                    $bedno++;
                        }
                    }
                }
            }
                else{
                    $form->status = '2';
                    $form->save();
            
            }
        }

        
        // 2nd round of allotment
        $application = application::orderBy('marks','desc')->where([['status','=','0'],['meritin','=','1']])->get();
        foreach ($application as $form) {
            echo "down enter";
                    $hostel = boyshostel::orderBy('roomno','ASC')->where([
                                                                ['status', '=', '0'],
                                                                ['roomtype', '=', '1'],
                                                            ])->first();
                if(is_null($hostel))
                   {
                    $hostel = boyshostel::orderBy('roomno','ASC')->where([
                                                                    ['status', '=', '0'],
                                                                    ['roomtype', '=', '2'],
                                                                ])->first();
                   }
                 if(is_null($hostel))
                   {
                    $hostel = boyshostel::orderBy('roomno','ASC')->where([
                                                                    ['status', '=', '0'],
                                                                    ['roomtype', '=', '3'],
                                                                ])->first();
                   }
                 if(is_null($hostel))
                   {
                    $hostel = boyshostel::orderBy('roomno','ASC')->where([
                                                                    ['status', '=', '0'],
                                                                    ['roomtype', '=', '4'],
                                                                ])->first();
                   }
                   if( $hostel != NULL)
                     {echo "down entry";
                        $room = $hostel;
                        $room->regno = $form->regno;
                        $room->name = $form->name;
                        $room->year = $form->year;
                        $room->branch = $form->branch;
                        $room->status = '1';
                        $room->save();

                        $set= application::find($form->regno);
                        $set->status = '1';
                        $set->save();
                    }
                }
    }

        $allot = boyshostel::whereNotNull('regno')->where([['status', '1'],['year',($year-'1')]])->orderBy('roomno','ASC')->get();
        return view('admin/result',compact('allot','id','beds','hostelname'));
    }
}