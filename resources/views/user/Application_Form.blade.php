@extends('layouts.user')

@section('stylesheets')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
	<div class="container">
	<div class="row">
		<div class="col-lg-2 col-sm-2 col-md-2"></div>
        <div class="col-lg-8 col-sm-8 col-md-8 form">
        	<div class=" row img "><img class="box-info" src="{{URL::asset('/img/ait.jpg')}}" alt="profile Pic"></div>

          <!-- Horizontal Form -->  
		@if (count($errors) > 0)
		  @foreach ($errors->all() as $error)
		    <p class="alert alert-danger">{{ $error }}</p>
		  @endforeach
		@endif

          <div class="box box-info">
            <h3 class="box-title text-center form-title font-weight-bold">Hostel Allotment Form</h3>
            <!-- form start Here-->
            <form role="form" action="{{ route('application.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
              <div class="box-body">
              	<div class="row">
              		<div class="col-lg-4 col-sm-4 col-md-4 "><b>Hostel Choices:</b></div>
              		<div class="row col-lg-8 col-sm-8 col-md-8">
          				<div class="col-lg-4 col-sm-4 col-md-4">
          					1.
          					<select class="form-control" name="hostel_pref1" required>
								<option SELECTED value=" ">Select</option>
			                  	@foreach($hostels as $hostel)
				                    <option value="{{ $hostel->hostel_id }}">{{ $hostel->hostelname}}</option>
				                @endforeach
	                      </select>
						</div>
						@if(count($hostels)=='2')
							<div class="col-lg-4 col-sm-4 col-md-4">
								2.
              					<select class="form-control" name="hostel_pref2" >
									<option SELECTED value=" ">NONE</option>
				                  	@foreach($hostels as $hostel)
					                    <option value="{{ $hostel->hostel_id }}">{{ $hostel->hostelname}}</option>
					                @endforeach
		                      </select>
							</div>
						@elseif(count($hostels)=='3')
							<div class="col-lg-4 col-sm-4 col-md-4">
								2.
              					<select class="form-control" name="hostel_pref2">
									<option SELECTED value=" ">NONE</option>
				                  	@foreach($hostels as $hostel)
					                    <option value="{{ $hostel->hostel_id }}">{{ $hostel->hostelname}}</option>
					                @endforeach
		                      </select>
							</div>
							<div class="col-lg-4 col-sm-4 col-md-4">
								3.
              					<select class="form-control" name="hostel_pref3">
									<option SELECTED value=" ">NONE</option>
				                  	@foreach($hostels as $hostel)
					                    <option value="{{ $hostel->hostel_id }}">{{ $hostel->hostelname}}</option>
					                @endforeach
		                      </select>
							</div>
						@elseif(count($hostels)=='4')
							<div class="col-lg-4 col-sm-4 col-md-4">
								2.
              					<select class="form-control" name="hostel_pref2">
									<option SELECTED value=" ">NONE</option>
				                  	@foreach($hostels as $hostel)
					                    <option value="{{ $hostel->hostel_id }}">{{ $hostel->hostelname}}</option>
					                @endforeach
		                      </select>
							</div>
							<div class="col-lg-4 col-sm-4 col-md-4">
								3.
              					<select class="form-control" name="hostel_pref3">
									<option SELECTED value="">NONE</option>
				                  	@foreach($hostels as $hostel)
					                    <option value="{{ $hostel->hostel_id }}">{{ $hostel->hostelname}}</option>
					                @endforeach
		                      </select>
							</div>
							<div class="col-lg-4 col-sm-4 col-md-4">
								4.
              					<select class="form-control" name="hostel_pref4">
									<option SELECTED value="">NONE</option>
				                  	@foreach($hostels as $hostel)
					                    <option value="{{ $hostel->hostel_id }}">{{ $hostel->hostelname}}</option>
					                @endforeach
		                      </select>
							</div>
						@endif
              		</div>
              	</div>
              	<strong style="color: red; padding: 15px;"> Select Different Hostel choices if you want your application to be considered for all optione. Deselecting any choice means you dont want allotment in that hostel.</strong>
              	<hr>
              	<div class="row">
              	  <div class="form-group col-lg-6 col-sm-6 col-md-6">
	                  <label for="regno" class="col-sm-6 control-label">Registration No</label>

	                  <div class="col-sm-6">
	                    <input type="text" class="form-control" id="regno" name="regno" value="{{ $user->regno }}" readonly>
	                  </div>
	                </div>
	                <div class="form-group col-lg-6 col-sm-6 col-md-6">
	                  <label for="rollno" class="col-sm-12 control-label">Roll No</label>

	                  <div class="col-sm-6">
	                    <input type="text" class="form-control" id="rollno" name="rollno" placeholder="Roll No" required>
	                  </div>
	                </div>
		        </div>
              	<div class="row">
              	  <div class="form-group col-lg-6 col-sm-6 col-md-6">
	                  <label for="Student Name" class="col-sm-12 control-label">Student Name</label>

	                  <div class="col-sm-12 ">
	                    <input type="text" class="form-control" id="Student Name" name="name" value="{{ $user->name }}" readonly>
	                  </div>
	                </div>
	                <div class="form-group col-lg-3 col-sm-3 col-md-3">
	                  <label>Current Year</label>
	                  <select class="form-control" name="year">
	                    <option value="1">FE</option>
	                    <option value="2">SE</option>
	                    <option value="3">TE</option>
	                  </select>
	                </div>
		        </div>
		        <hr>
		        <div class="row">
              	    <div class="form-group col-lg-4 col-sm-4 col-md-4">
	                  <label for="merit" class="control-label ">Cumulatice merit</label>
						<div class="col-sm-12 ">
	                    <input type="text" class="form-control " id="merit" name="marks" value="{{ ($usermerit->merit)/100 }}" readonly>
	                  </div>
	                  <strong style="color: red; padding: 15px;"> Academic - {{ ($usermerit->academics)/100 }} SGPA and  Attendance - {{ ($usermerit->attendance)/100 }}%.</strong>
	                </div>
		        	<div class="form-group col-lg-4 col-sm-4 col-md-4">
	                  <label for="accomodation for" class="col-sm-12 control-label">Accomodation For:</label>
	                  <select class="form-control col-sm-6 " name="accm_for" readonly>
	                    <option value="{{$accomodationfor->year}}">{{$accomodationfor->name}}</option>
	                  </select>
	                </div>
	                <div class="form-group col-lg-4 col-sm-4 col-md-4">
	                  <label class="control-label">branch</label>
	                  <select class="form-control col-sm-6 " name="branch" readonly>
	                    <option value="{{$user->branch}}">{{$user->branchname->name}}</option>
	                  </select>
	                </div>
		        </div>
				<hr>
		        <fieldset>
    			<legend style="font-size: 18px; text-align:left;">Floor Preferences</legend>
	            <div class="row">
	                <div class="form-group col-lg-3 col-sm-3 col-md-3">
	                  <label>1st Preference</label>
	                  <select class="form-control" name="floor_pref1">
	                    <option selected value="0">Ground Floor</option>
	                    <option value="1">First Floor</option>
	                    <option value="2">Second Floor</option>
	                    <option value="3">Third Floor</option>
	                  </select>
	                </div>
	                <div class="form-group col-lg-3 col-sm-3 col-md-3">
	                  <label>2nd Preference</label>
	                  <select class="form-control" name="floor_pref2">
	                    <option value="0">Ground Floor</option>
	                    <option selected value="1">First Floor</option>
	                    <option value="2">Second Floor</option>
	                    <option value="3">Third Floor</option>
	                  </select>
	                </div>
	                <div class="form-group col-lg-3 col-sm-3 col-md-3">
	                  <label>3rd Preference</label>
	                  <select class="form-control" name="floor_pref3">
	                    <option value="0">Ground Floor</option>
	                    <option value="1">First Floor</option>
	                    <option selected value="2">Second Floor</option>
	                    <option value="3">Third Floor</option>
	                  </select>
	                </div>
	                <div class="form-group col-lg-3 col-sm-3 col-md-3">
	                  <label>4th Preference</label>
	                  <select class="form-control" name="floor_pref4">
	                    <option value="0">Ground Floor</option>
	                    <option value="1">First Floor</option>
	                    <option value="2">Second Floor</option>
	                    <option selected value="3">Third Floor</option>
	                  </select>
	                </div>
		        </div>
		        <strong style="color: red; padding: 15px;"> Selecting same choice for more that one option simply means you only want Accomodation in those floors.Rest options will be ignored for your allotment even if room remains vacant.</strong>
		    	</fieldset>
		    	<br>
		    	<fieldset>
    			<legend style="font-size: 18px; text-align:left;">Room Preferences</legend>
		        <div class="row">
              	    <div class="form-group col-lg-6 col-sm-6 col-md-6">
	                  <label for="merit" class="control-label col-sm-12">1st Preference</label>
	                    <div class="form-control col-sm-12">
	                    <label class="col-sm-5">
		                  <input type="radio" name="pref1" value="1" class="minimal-red" checked>
		                  Siglet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref1" value="2" class="minimal-red">
		                  Doublet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref1" value="3" class="minimal-red">
		                  Triplet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref1" value="4" class="minimal-red">
		                  Fourlet
		                </label>
		                </div>
	                </div>
	                <div class="form-group col-lg-6 col-sm-6 col-md-6">
	                  <label for="merit" class="control-label col-sm-12">2nd Preference</label>
	                    <div class="form-control col-sm-12">
	                    <label class="col-sm-5">
		                  <input type="radio" name="pref2" value="1" class="minimal-red">
		                  Siglet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref2" value="2" class="minimal-red" checked>
		                  Doublet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref2" value="3" class="minimal-red">
		                  Triplet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref2" value="4" class="minimal-red">
		                  Fourlet
		                </label>
		                </div>
	                </div>
		        </div>
		        <div class="row">
              	    <div class="form-group col-lg-6 col-sm-6 col-md-6">
	                  <label for="merit" class="control-label col-sm-12">3rd Preference</label>
	                    <div class="form-control col-sm-12">
	                    <label class="col-sm-5">
		                  <input type="radio" name="pref3" value="1" class="minimal-red">
		                  Siglet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref3" value="2" class="minimal-red">
		                  Doublet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref3" value="3" class="minimal-red" checked>
		                  Triplet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref3" value="4" class="minimal-red">
		                  Fourlet
		                </label>
		                </div>
	                </div>
	                <div class="form-group col-lg-6 col-sm-6 col-md-6">
	                  <label for="merit" class="control-label col-sm-12">4th Preference</label>
	                    <div class="form-control col-sm-12">
	                    <label class="col-sm-5">
		                  <input type="radio" name="pref4" value="1" class="minimal-red">
		                  Siglet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref4" value="2" class="minimal-red" >
		                  Doublet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref4" value="3" class="minimal-red">
		                  Triplet
		                </label>
		                <label class="col-sm-5">
		                  <input type="radio" name="pref4" value="4" class="minimal-red" checked>
		                  Fourlet
		                </label>
		                </div>
	                </div>
	            </div>
	            <strong style="color: red; padding: 15px;"> Selecting same choice for more that one option simply means you only want Accomodation in those type.Rest options will be ignored for your allotment even if room remains vacant.</strong>
	        	</fieldset>
		        <hr>
		        <div class="row">
		        	<label class="control-label  col-sm-12">Room-mates Preferences</label>
		        	<div class="form-group col-lg-12 col-sm-12 col-md-12 form-inline">
					  <div class="form-group col-lg-3 col-sm-3 col-md-3">
					    <label for="staticEmail2">1st Preference</label>
					  </div>
					  <div class="form-group col-lg-9 col-sm-9 col-md-9">
					    <input type="text" class="form-control col-lg-4 col-sm-4 col-md-4" id="pref_regno" name="mate1" placeholder="Enter Reg No">
					    <div class="col-lg-1 col-sm-1 col-md-1"></div>
					    <input type="text" class="form-control col-lg-7 col-sm-7 col-md-7" id="pref_name" placeholder="Enter Name">
					  </div>
					</div>
					<div class="form-group col-lg-12 col-sm-12 col-md-12 form-inline">
					  <div class="form-group col-lg-3 col-sm-3 col-md-3">
					    <label for="staticEmail2">2nd Preference</label>
					  </div>
					  <div class="form-group col-lg-9 col-sm-9 col-md-9">
					    <input type="text" class="form-control col-lg-4 col-sm-4 col-md-4" id="pref_regno" name="mate2" placeholder="Enter Reg No">
					    <div class="col-lg-1 col-sm-1 col-md-1"></div>
					    <input type="text" class="form-control col-lg-7 col-sm-7 col-md-7" id="pref_name" placeholder="Enter Name">
					  </div>
					</div>
					<div class="form-group col-lg-12 col-sm-12 col-md-12 form-inline">
					  <div class="form-group col-lg-3 col-sm-3 col-md-3">
					    <label for="staticEmail2">3rd Preference</label>
					  </div>
					  <div class="form-group col-lg-9 col-sm-9 col-md-9">
					    <input type="text" class="form-control col-lg-4 col-sm-4 col-md-4" id="pref_regno" name="mate3" placeholder="Enter Reg No">
					    <div class="col-lg-1 col-sm-1 col-md-1"></div>
					    <input type="text" class="form-control col-lg-7 col-sm-7 col-md-7" id="pref_name" placeholder="Enter Name">
					  </div>
					</div>
		        </div>

              </div>
              <hr>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <button type="submit" class="btn btn-info">Submit Application</button>
              </div>
              <strong style="color: red; padding: 15px;"> Submit Your Application only if you accept your merit else Contact administrator.</strong>
              <!-- /.box-footer -->
            </form>
          </div>
      </div>
      <div class="col-lg-2 col-sm-2 col-md-2"></div>
  </div>
</div>
      
@endsection