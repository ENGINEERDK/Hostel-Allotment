@extends('vendor.multiauth.layouts.app')

@section('head')
<link href="{{ asset('css/addhostelroom.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('content')
<h1 class="text-center">
    @if($id=='1')
    First Year Students
    @elseif($id=='2')
    Second Year Students
    @elseif($id=='3')
    Third Year Students
    @elseif($id=='4')
    Final Year Students
    @endif
</h1>
 <div class="container">
    <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6 text-left"><h2>Rooms <b>Statistics</b></h2></div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('merit.show', array('id' => $id)) }}" class="btn btn-warning">Students Merit</a>
                        <a href="{{ route('allotment.show', array('id' => $id)) }}" class="btn btn-danger">Hostel Applications</a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-sm-3 col-lg-3 col-md-3"></div>
                <div class="col-sm-3 col-lg-3 col-md-3"><h3>Hostel Alloted </h3></div>
                <div class="col-sm-6 col-lg-6 col-md-6">
                    @foreach($hostels as $hostel)
                    <a href="#" class="btn btn-success " ><b>{{ $hostel->hostelname}}</b></a>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="text-center ">
                <div class="btn btn-info" style="pointer-events: none;">
                    <h5>Total Bed Capacity : <b>{{ $beds }}  Beds</b></h5>
                </div>
                <div class="btn btn-info" style="pointer-events: none;">
                    <h5>Total Strenght : <b>{{ count($alloted) }} Students</b></h5>
                </div>
            </div>
            <div class="text-center">
                <div>
                    <div class="btn btn-sm btn-warning" style="pointer-events: none;">
                        <p>IT Seats : <b>{{ $it_allot }} </b></p>
                    </div>
                    <div class="btn btn-sm btn-warning" style="pointer-events: none;">
                        <p>MECH Seats : <b>{{ $mech_allot }} </b></p>
                    </div>
                    <div class="btn btn-sm btn-warning" style="pointer-events: none;">
                        <p>E&TC I Seats : <b>{{ $entc1_allot }} </b></p>
                    </div>
                    <div class="btn btn-sm btn-warning" style="pointer-events: none;">
                        <p>E&TC II Seats : <b>{{ $entc2_allot }} </b></p>
                    </div>
                    <div class="btn btn-sm btn-warning" style="pointer-events: none;">
                        <p>COMP I Seats : <b>{{ $comp1_allot }}</b></p>
                    </div>
                    <div class="btn btn-sm btn-warning" style="pointer-events: none;">
                        <p>COMP II Seats : <b>{{ $comp2_allot }}</b></p>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center">
                @if (Session::has('message'))
                <div class=" col-sm-6 col-lg-6 col-md-6 mx-auto">
                    <br>
                   <div class="alert alert-success">{{ Session::get('message') }}</div>
                </div>
                @endif
            </div>
        </div>
        <br>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6"><h2>Hostel <b>Accomodation</b></h2></div>
                    <div class="col-sm-6 text-right">
                        <a href="{{route('allotmentexcel', array('year' => $id)) }}" class="btn btn-warning">Download Accomodation in Excel</a>
                        <a href="{{ route('application.show', array('id' => $id)) }}" class="btn btn-danger">Vacate Hostels</a></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hostel</th>
                        <th>Floor</th>
                        <th>Room No</th>
                        <th>Bed No</th>
                        <th>Reg No</th>
                        <th>Name</th>
                        <th>year</th>
                        <th>Branch</th>
                        <th>Type of Room</th>
                    </tr>
                </thead>
                <tbody>
                    @if( count($alloted) ==0)
                        <td colspan="10">
                            <h4>No Room Alloted.</h4>
                        </td>
                    @else

                    @foreach ($alloted as $allot)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{$allot->hostel->hostelname}}</td>
                        <td>{{$allot->floorname->name}}</td>
                        <td>{{$allot->roomno}}</td>
                        <td>{{$allot->bedno}}</td>
                        <td>{{$allot->regno}}</td>
                        <td>{{$allot->name}}</td>
                        <td>{{$allot->studentyear->name}}</td>
                        <td>{{$allot->studentbranch->name}}</td>
                        <td>{{$allot->typeofroom->name}}</td>
                    </tr> 
                    @endforeach  
                    @endif   
                </tbody>
            </table>
            </table>
            <div style="text-align:center;">
                {{ $alloted->links() }}
            </div>
        </div>
    </div>
    
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection