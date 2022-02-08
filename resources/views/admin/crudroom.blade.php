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

        <form role="form" action="{{ route('allotment.store') }}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Add <b>Room</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Floor</th>
                        <th>Type of Room</th>
                        <th>Room No</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <input type="hidden" name="hostel_id" readonly value="<?php  echo $id; ?>">
                        <td>1</td>
                        <td><select class="form-control text-center" name="floor" id="floor" value="{{ old('floor') }}">
                            <option style="font-weight: bold; font-size: 15px;">Select</option>
                            @foreach ($floors as $floor)
                                <option value={{$floor->floor}}>{{$floor->name}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                            <select class="form-control text-center" name="roomtype" id="roomtype" value="{{ old('roomtype') }}" onclick="reserved()" onkeyup = "if ((event.keyCode == 40) || (event.keyCode == 38))
                        document.getElementById('roomtype').click()">
                            <option style="font-weight: bold; font-size: 15px;">Select</option>
                            @foreach ($roomtypes as $roomtype)
                                <option value="{{$roomtype->roomtype}}" > {{$roomtype->name}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                            <input type="text" class="form-control text-center" name="roomno" id="roomno" value="{{ old('roomno') }}">
                        </td>
                    </tr>      
                </tbody> 
            </table>
            <div class="row" style="display: none; padding: 10px;" id="reservation">
                <div class="col-lg-3 col-sm-3 col-md-3"></div>
                <div class="col-lg-3 col-sm-3 col-md-3" style="font-weight: 600; font-size: 15px;">
                    Room Reserved For:-
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3" >
                    <select class="form-control" name="allotonly">
                        @foreach($branches as $branch)
                            <option value={{$branch->branch}}>{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3"></div>
            </div>
            <div class="text-right">
                    <button type="submit" class="btn btn-info"> Add New Room</button>
            </div>
            <div class="text-center">
                @if (Session::has('message'))
                <div class=" col-sm-6 col-lg-6 col-md-6 mx-auto">
                    <br>
                   <div class="alert alert-danger">{{ Session::get('message') }}</div>
                </div>
                @endif
            </div>
        </div>
        </form>

        <br>

        <div class="table-wrapper">
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
            @endif
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Rooms <b>Availability</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Floor</th>
                        <th>Room No</th>
                        <th>Type of Room</th>
                        <th>Reservation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($boyshostels as $boyshostel)
                    <tr>
                        <td><b>{{ $loop->index + 1 }}</b></td>
                        <td>{{$boyshostel->floorname->name}}</td>
                        <td>{{$boyshostel->roomno}}</td>
                        <td class="text-center">
                            @if($boyshostel->roomtype==1)
                                <i class="material-icons">hotel</i>
                            @endif
                            @if($boyshostel->roomtype==2)
                                <i class="material-icons">hotel</i>
                                <i class="material-icons">hotel</i>
                            @endif
                            @if($boyshostel->roomtype==3)
                                <i class="material-icons">hotel</i>
                                <i class="material-icons">hotel</i>
                                <i class="material-icons">hotel</i>
                            @endif
                            @if($boyshostel->roomtype==4)
                                <i class="material-icons">hotel</i>
                                <i class="material-icons">hotel</i>
                                <i class="material-icons">hotel</i>
                                <i class="material-icons">hotel</i>
                            @endif
                        </td>
                        <td>@if($boyshostel->reservation)
                            {{$boyshostel->reservation->name}}
                            @endif
                        </td>
                        <td>
                            {{ Form::open(['method' => 'DELETE', 'route' => ['allotment.destroy', $boyshostel->roomno]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    </tr> 
                @endforeach    
                </tbody>
            </table>
        </div>
        <br>

    </div>
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection