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
     Merit
    </h1>
 <div class="container">

        
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6 col-lg-6"><h2>Import Merit Data <b>From Excel</b></h2></div>
                </div>
            </div>

            <form action="{{ route('meritimport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <div class="text-right"><button class="btn btn-warning ">Import Merit Data</button></div>
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
            <form role="form" action="{{ route('merit.store') }}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="table-title">
                <div class="row">
                    <div class="col-sm-8 col-lg-8"><h2>Add Student <b>Merit Data</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Registration No.</th>
                        <th>Academics</th>
                        <th>Attendance</th>
                        <th>Final Merit</th>
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
                            <input type="text" class="form-control text-center{{ $errors->has('acad') ? ' is-invalid' : '' }}" name="acad" id="acad" value="{{ old('acad') }}">
                            @if ($errors->has('acad'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('acad') }}</strong>
                                    </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" class="form-control text-center {{ $errors->has('attendance') ? ' is-invalid' : '' }}" name="attendance" id="attendance" value="{{ old('attendance') }}">
                            @if ($errors->has('attendance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('attendance') }}</strong>
                                    </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" class="form-control text-center{{ $errors->has('merit') ? ' is-invalid' : '' }}" name="merit" id="merit" value="{{ old('merit') }}">
                            @if ($errors->has('merit'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('merit') }}</strong>
                                    </span>
                            @endif
                        </td>
                        <input name="year" type="hidden" value="{{$id}}">
                    </tr>      
                </tbody> 
            </table>
            <div class="text-right">
                    <button type="submit" class="btn btn-info"> Add Merit Data</button>
            </div>
        </div>
        </form>
        <br>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row ">
                    <div class="col-sm-6 col-lg-6"><h2>Students <b>Merit List</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Registration No.</th>
                        <th>Academics</th>
                        <th>Attendance</th>
                        <th>Final Merit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($studentmerits as $studentmerit)
                    <tr>
                        <td><b>{{ $loop->index + 1 }}</b></td>
                        <td>{{ $studentmerit->regno}}</td>
                        <td>{{ ($studentmerit->academics)/100}}</td>
                        <td>{{ ($studentmerit->attendance)/100 }}</td>
                        <td>{{ ($studentmerit->merit)/100 }}</td>
                        <td>
                            {{ Form::open(['method' => 'DELETE', 'route' => ['merit.destroy', $studentmerit->regno]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                    </tr> 
                @endforeach    
                </tbody>
            </table>
            <div style="text-align:center;">
                {{ $studentmerits->links() }}
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