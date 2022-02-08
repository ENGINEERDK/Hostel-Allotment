@extends('vendor.multiauth.layouts.app')

@section('head')
<link href="{{ asset('css/addhostelroom.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('content')
    <h1 class="text-center"> Student/User Details</h1>
 <div class="container">

        
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6 col-lg-6"><h2>Import Details <b>From Excel</b></h2></div>
                </div>
            </div>

            <form action="{{ route('userdetailsimport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <div class="text-right"><button class="btn btn-warning ">Import Details</button></div>
            </form>

        </div>
        <br>
        <div class="text-right">
            @if (session('status'))
              <div class="alert alert-success text-center">
                {{ session('status') }}
              </div>
            @endif
            @if (session('warning'))
              <div class="alert alert-warning text-center">
                {{ session('warning') }}
              </div>
            @endif
        </div>
        <div class="table-wrapper">
            <form role="form" action="{{ route('info.store') }}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="table-title">
                <div class="row">
                    <div class="col-sm-8 col-lg-8"><h2>Add Student <b>Record</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Reg No.</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Branch</th>
                        <th>Email</th>
                        <th>Sex</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="text" class="form-control text-center {{ $errors->has('regno') ? ' is-invalid' : '' }}" name="regno" id="regno" value="{{ old('regno') }}">
                            @if ($errors->has('regno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('regno') }}</strong>
                                    </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" class="form-control text-center{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </td>
                        <td>
                            <select class="form-control text-center" name="year" id="year" value="{{ old('year') }}">
                            <option style="font-weight: bold; font-size: 15px;">Select</option>
                            @foreach ($years as $year)
                                <option value={{$year->year}}>{{$year->name}}</option>
                            @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control text-center" name="branch" id="branch" value="{{ old('branch') }}">
                            <option style="font-weight: bold; font-size: 15px;">Select</option>
                            @foreach ($branches as $branch)
                                <option value={{$branch->branch}}>{{$branch->name}}</option>
                            @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="email" class="form-control text-center {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </td>
                        <td>
                            <select class="form-control text-center" name="sex" id="sex" value="{{ old('sex') }}">
                            <option style="font-weight: bold; font-size: 15px;">Select</option>
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                        </td>
                        {{-- <input name="year" type="hidden" value="{{$id}}"> --}}
                    </tr>      
                </tbody> 
            </table>
            <div class="text-right">
                    <button type="submit" class="btn btn-info"> Add Student Data</button>
            </div>
        </div>
        </form>
        <br>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row ">
                    <div class="col-sm-8 col-lg-8"><h2>All Students <b>Details</b></h2></div>
                    <div class="col-sm-4 col-lg-4">
                        <h2> Total Users : <b>{{ $studentdetails->total() }} </b> </h2>
                    </div>
                </div>
                
                
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Reg No.</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Branch</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($studentdetails as $studentdetail)
                    <tr>
                        <td><b>{{ (($studentdetails->currentPage() - 1 ) * $studentdetails->perPage() ) + $loop->iteration }}</b></td>
                        <td>{{$studentdetail->regno}}</td>
                        <td>{{$studentdetail->name}}</td>
                        <td>{{$studentdetail->yearname->name}}</td>
                        <td>{{$studentdetail->branchname->name}}</td>
                        <td> 
                            <input type="email" class="form-control text-center"value="{{$studentdetail->email}}">
                        </td>
                        <td>
                            {{ Form::open(['method' => 'DELETE', 'route' => ['info.destroy', $studentdetail->regno]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    </tr> 
                @endforeach    
                </tbody>
            </table>
            <div style="text-align:center;">
                {{ $studentdetails->links() }}
            </div>
        </div>
        <br>

    </div>
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection