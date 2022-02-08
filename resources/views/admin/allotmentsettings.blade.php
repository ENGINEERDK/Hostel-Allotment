@extends('vendor.multiauth.layouts.app')

@section('head')
<link href="{{ asset('css/addhostelroom.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('content')
<h1 class="text-center">Army Institute of Techology Pune</h1>
<br>
 <div class="container">
        <div class="table-wrapper">
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
            @endif
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
        <br>
        <div class="table-wrapper">
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
            @endif
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12"><h2>Capacity <b>Planning</b></h2><small>( Set Branch-wise vacanccy according to Total strength. )</small></div>
                </div>
                <hr>
            </div>
            <div class="row text-center">
                <div class="col-sm-8 col-lg-8 col-md-8"><h5>Total Applicants for Accomodation -    <b>"00000"</b></h5></div>
                <div class="col-sm-8 col-lg-8 col-md-8"><h5>Total no Accomodation available -    <b>"000000"</b></h5></div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <a href="{{ route('capacitysettings.index') }}" class="btn btn-info" target="_blank">Update Branch-wise Capacity</a>
                </div>
            </div>
            <br>
        </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection