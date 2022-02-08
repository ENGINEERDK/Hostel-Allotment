<?php

namespace App\Http\Controllers;

use App\Studentmerit;
use Illuminate\Http\Request;

use App\Imports\MeritImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentmeritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'regno' => 'required|numeric|unique:studentmerits',
            'acad' => 'required|numeric',
            'attendance' => 'required|numeric',
            'merit' => 'required|numeric',
            ]);
            // $year=0;
            // if($request->year=='1')
            //     $request->year="FE";
            // elseif($request->year=='2')
            //     $request->year="SE";
            // elseif($request->year=='3')
            //     $request->year="TE";
            // elseif($request->year=='4')
            //     $request->year="BE";
            // else
            //     $request->year = "ME";

            $merit= new Studentmerit;
            $merit->regno = $request->regno;
            $merit->year = $request->year;
            $merit->academics = ($request->acad)*100;
            $merit->attendance = ($request->attendance)*100;
            $merit->merit = ($request->merit*100);
            $merit->save();

            return back()->with('status', 'Entry Successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Studentmerit  $studentmerit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentmerits = Studentmerit::where('year',$id)->orderBy('regno','ASC')->paginate(50);
        return view('admin/studentmerit',compact('id','studentmerits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentmerit  $studentmerit
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentmerit $studentmerit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentmerit  $studentmerit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentmerit $studentmerit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentmerit  $studentmerit
     * @return \Illuminate\Http\Response
     */
    public function destroy($regno)
    {
        $studentmerit = Studentmerit::where('regno',$regno)->first();
        $studentmerit->delete();
        return back()->with('status', 'Student Merit Deleted succesfully.');
    }
    public function importstudentmerit()
    {
        Excel::import(new MeritImport,request()->file('file'));
        return back()->with('status','Excel Import Successful.');
    }

}
