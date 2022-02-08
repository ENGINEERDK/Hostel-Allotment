<?php

namespace App\Http\Controllers;

use App\User;
use App\year;
use App\branch;
use App\Userdetail;
use Illuminate\Http\Request;

use App\Imports\UserdetailImport;
use Maatwebsite\Excel\Facades\Excel;

class UserdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = year::get();
        $branches = branch::get();
        $studentdetails = Userdetail::orderBy('regno','ASC')->paginate(150);
        return view('admin/studentdetails',compact('years','branches','studentdetails'));
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
            'regno' => 'required|numeric|unique:user_data',
            'name' => 'required',
            'year' => 'required|numeric|between:0,6',
            'branch' => 'required|numeric|between:0,6',
            'email' => 'required',
            'sex' => 'required',
            ]);

            $user= new Userdetail;
            $user->regno = $request->regno;
            $user->name = $request->name;
            $user->year = $request->year;
            $user->branch = $request->branch;
            $user->email = $request->email;
            $user->sex = $request->sex;
            $user->save();

            return back()->with('status', 'User Entry Successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Userdetail  $userdetail
     * @return \Illuminate\Http\Response
     */
    public function show(Userdetail $userdetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Userdetail  $userdetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Userdetail $userdetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Userdetail  $userdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userdetail $userdetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Userdetail  $userdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($regno)
    {
        $user = Userdetail::where('regno',$regno)->first();
        $user->delete();
        return back()->with('status', 'Student Record Deleted succesfully.');
    }

    public function userregistration(Request $request)
    {
        $data=Userdetail::whereRegno($request->id)->take(1)->get();
        return response()->json($data);
    }
    
    public function verifyuser($token)
    {
        User::where('token',$token)->FirstOrFail()->update(['token' => null]);

        return redirect()
            ->route('login')
            ->with('status','Account Verified Succesfully. You can now Login.');

    }
    public function importuserdetails(){
        Excel::import(new UserdetailImport,request()->file('file'));
        return back()->with('status','User Details Excel Import Successful.');
    }
}
