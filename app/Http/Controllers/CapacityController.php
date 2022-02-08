<?php

namespace App\Http\Controllers;

use App\Capacity;
use App\year;
use Illuminate\Http\Request;

class CapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }
    
    public function index()
    {
        $capacity = Capacity::get();
        $years = year::orderBy('year','ASC')->get();
        return view('admin/capacitysettings',compact('capacity','years'));
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
            'year' => 'required|unique:capacities',
            ]);

        $capacity = new Capacity;
        $capacity->year = $request->year;
        $capacity->it = $request->it;
        $capacity->mech = $request->mech;
        $capacity->entc = $request->entc;
        $capacity->comp = $request->comp;
        $capacity->save();

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
        $capacity = Capacity::where('year',$id);
        $capacity->delete();
        return back();
    }
}
