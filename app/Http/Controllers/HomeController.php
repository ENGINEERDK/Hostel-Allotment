<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\application;
use App\boyshostel;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = boyshostel::where('regno',Auth::user()->regno)->first();
        $application = application::where('regno',Auth::user()->regno)->first();
        $roommates = [[]];
        if(!is_null($result))
            $roommates = boyshostel::where([['id','!=',$result->id],['roomno',$result->roomno],['hostel_id',$result->hostel_id]])->get();

        return view('user/dashboard', compact('result','application','roommates'));
    }
}
