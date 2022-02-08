@extends('vendor.multiauth.layouts.app')

@section('head')
<link href="{{ asset('css/addhostelroom.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('content')
<h2 class="text-center">Army Institute of Techology Pune</h2>
 <div class="container">
        <div class="table-wrapper">
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
            @endif
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Boys <b>Hostel</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hostel ID</th>
                        <th>Hostel Name</th>
                        <th>Category</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hostel as $hostel)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $hostel->hostel_id}}</td>
                        <td>{{ $hostel->hostelname}}</td>
                        <td>{{ $hostel->hostelcategory->name}}</td>
                        <td>
                            {{ Form::open(['method' => 'DELETE', 'route' => ['hostels.destroy', $hostel->hostel_id]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    </tr> 
                    @endforeach     
                </tbody>
            </table>
        </div>
        <br>

        <form role="form" action="{{ route('hostels.store') }}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Add New <b>Hostel</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hostel ID</th>
                        <th><b>Hostel Name</b></th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>

                        <td><input type="text" class="form-control text-center" name="hostel_id" value="{{ old('hostel_id') }}" id="hostel_id"></td>

                        <td><input type="text" class="form-control text-center" name="hostelname" value="{{ old('hostelname') }}" id="hostel_id"></td>

                        <td><select class="form-control text-center" name="hostelcategory" id="hostelcategory" value="{{ old('hostelcategory') }}">
                            <option style="font-weight: bold; font-size: 15px;">Select</option>
                            @foreach ($hostelcategories as $hostelcategory)
                                <option value={{$hostelcategory->category}}>{{$hostelcategory->name}}</option>
                            @endforeach
                          </select>
                        </td>
                        
                    </tr>      
                </tbody>
            </table>
            <div class="text-right">
                    <button type="submit" class="btn btn-info"> Add Hostel</button>
            </div>
            </div>
        </form>
</div>
	
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection