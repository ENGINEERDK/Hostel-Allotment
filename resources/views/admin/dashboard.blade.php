@extends('vendor.multiauth.layouts.app')

@section('head')
<link href="{{ asset('css/addhostelroom.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('content')
<h2 class="text-center page_heading">Army Institute of Techology Pune</h2>
 <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Hostel Allotment<b> Year-wise</b></h2></div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <a href="{{ route('FirstYear.index') }}" class="btn btn-warning" target="_blank">First year Hostels</a>
                    </div>
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <a href="{{ route('SecondYear.index') }}" class="btn btn-warning" target="_blank">Second year Hostels</a>
                    </div>
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <a href="{{ route('ThirdYear.index') }}" class="btn btn-warning" target="_blank">Third year Hostels</a>
                    </div>
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <a href="{{ route('FourthYear.index') }}" class="btn btn-warning" target="_blank">Fourth year Hostels</a>
                    </div>
                </div>
            </div>
            @if (Session::has('message'))
                <div class="text-center">
                    <br>
                   <div class="alert alert-danger">{{ Session::get('message') }}</div>
                </div>
            @endif
        </div>
        <br>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Hostel <b>Statistics</b></h2></div>
                    <div class="col-sm-4 text-right"><a href="{{ route('hostels.index') }}" class="btn btn-info " target="_blank">Manage Hostels -CRUD</a></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hostel ID</th>
                        <th>Hostel Name</th>
                        <th>Manage Rooms</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hostels as $hostel)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><b>{{ $hostel->hostel_id}}</b></td>
                        <td><b> {{ $hostel->hostelname}} </b></td>
                        <td><a href="{{ route('hosteldashboard', array('id' => $hostel->hostel_id)) }}" class="btn btn-success ">Hostel Dashboard</a></td>
                    </tr> 
                    @endforeach   
                </tbody>
            </table>
        </div>
        <br>
        {{--
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12"><h2>Accomodation <b>Planning</b></h2><small>( Set the hostels to be alloted year-wise )</small></div>
                </div>
                <hr>
            </div>
            <div class="row text-center">
                <div class="col-sm-8 col-lg-8 col-md-8"><h5>Total Boys Hostels/Flanks for Accomodation-    <b>{{ $totalhostel }}</b></h5></div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <a href="{{ route('managehostels.index') }}" class="btn btn-info" target="_blank">Manage Hostel Planning</a>
                </div>
            </div>
            <br>
        </div>
        --}}
    </div>
    
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection