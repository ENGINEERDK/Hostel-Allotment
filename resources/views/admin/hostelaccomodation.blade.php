@extends('vendor.multiauth.layouts.app')

@section('head')
<link href="{{ asset('css/addhostelroom.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('content')
<h1 class="text-center">{{ $hostelname }}</h1>
 <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Room <b>Statistics</b></h2></div>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-sm-2 col-lg-2 col-md-2"></div>
                <div class="col-sm-6 col-lg-6 col-md-6"><h5>Present Hostel Capacity -<b>{{ $beds }}  Beds</b></h5></div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <a href="{{ route('boyshostel', array('id' => $id)) }}" class="btn btn-success " target="_blank">Manage Room</a>
                </div>
            </div>
            <br>
            <div class="text-center">
                
            </div>
        </div>
        <br>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Room <b>Accomodation</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
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
                    @if( count($boyshostels) ==0)
                        <td colspan="9">
                            <h4>No Room Alloted.</h4>
                        </td>
                    @else

                    @foreach ($boyshostels as $boyshostel)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{$boyshostel->floorname->name}}</td>
                        <td>{{$boyshostel->roomno}}</td>
                        <td>{{$boyshostel->bedno}}</td>
                        <td>{{$boyshostel->regno}}</td>
                        <td>{{$boyshostel->name}}</td>
                        <td>{{$boyshostel->studentyear->name}}</td>
                        <td>{{$boyshostel->studentbranch->name}}</td>
                        <td>{{$boyshostel->typeofroom->name}}</td>
                    </tr> 
                    @endforeach  
                    @endif   
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection