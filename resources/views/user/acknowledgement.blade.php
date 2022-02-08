@extends('layouts.user')

@section('content')
<br>
<h1 class="text-center">Welcome to Online Merit based Hostel Allotment Portal</h1>
<h3 class="text-center">of Army Institute of Techology Pune</h3>

<div class="container">
	@if (session('success'))
      <div class="alert alert-success text-center">
        {{ session('status') }}
      </div>
    @endif
    @if (session('warning'))
      <div class="alert alert-warning text-center ">
        {{ session('warning') }}
      </div>
    @endif

	<div class="card" style="padding: 30px;margin: 20px;">
		<h3 class="text-center" style="font-weight: 600; font-size: 2em;">Instructions and Terms & Conditions</h3>
		<br>
		<ol class="custom-counter">
			<li>Allotment will be fully based on Final merit calculated from Academics and Attendance record taken in fixed proportionby hostel management.</li>
		    <li>Setting any preference to NONE means allotment will be disabled for you for that option.</li>
		    <li>Allotment preference order is Room Type > Hostel > Floor.</li>
		    <li>To get the prefered Room-mates necessarily need Roomates to prefer you as well in their application.</li>
		    <li>Select the Accomodation for the year you will ge going Next.</li>
		    <li>Once accomodation is provided. Student will be bound to accept. So please consider before filling.</li>
		</ol>
		<hr>

	<form role="form" action="{{ route('getapplicationform') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
		<div class="row text-center">
			<div class="col-lg-3">
				<span><b>Gender</b></span>
				<div class="radio">
			      <label><input type="radio" name="gender" value="1" >Male </label>
			      <label><input type="radio" name="gender" value="2" >Female </label>
			    </div>
			    <strong style="color: red">{{ $errors->first('gender') }}</strong>
			</div>
			<div class="col-lg-3">
				<span><b>Accomodation For:-</b></span>
				<select class="form-control" id="year" name="year">
					<option value="">Select</option>
				    <option value="1">FE</option>
				    <option value="2">SE</option>
				    <option value="3">TE</option>
				    <option value="4">BE</option>
				    <option value="5">ME</option>
				</select>
				<strong style="color: red">{{ $errors->first('year') }}</strong>
			</div>
			<div class="col-lg-6">
				<div class="terms-n-condition">
					<p class="text-center"><input type="CHECKBOX" name="Checkbox" value="This..."> I agree with the above Terms & Conditions.</p>
					<p class="text-center" style="color: red"> <strong>{{ $errors->first('Checkbox') }}</strong></p>
				</div>

				<button type="submit" class="btn btn-info"> Proceed to Aplication Form</button>
			</div>
			@if (Session::has('message'))
				<div class="mx-auto">
					<br>
				   <div class="alert alert-danger">{{ Session::get('message') }}</div>
				</div>
			@endif

		</div>
	</form>
	</div>
</div>
	
@endsection