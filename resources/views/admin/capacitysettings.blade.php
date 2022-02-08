@extends('vendor.multiauth.layouts.app')

@section('head')
<link href="{{ asset('css/addhostelroom.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('content')
<h1 class="text-center">Army Institute of Techology Pune</h1>
 <div class="container">
        <div class="table-wrapper">
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
            @endif
            {{-- Hostel Alloted Yearwise --}}
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Year wise <b>Student Strength</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Year</th>
                        <th>IT</th>
                        <th>Mech</th>
                        <th>E&TC</th>
                        <th>COMP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($capacity as $capacity)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $capacity->yearname->name}} </td>
                            <td>{{ $capacity->it}} </td>
                            <td>{{ $capacity->mech}} </td>
                            <td>{{ $capacity->entc}} </td>
                            <td>{{ $capacity->comp}} </td>
                            <td>  
                                {{--<a class="btn btn-danger" href = 'capacitysettings/{{$capacity->year}}/edit'>Delete</a>--}}
                                {{ Form::open(['method' => 'DELETE', 'route' => ['capacitysettings.destroy',$capacity->year]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr> 
                    @endforeach    
                </tbody>
            </table>
        </div>
        <br>

        <form role="form" action="{{ route('capacitysettings.store') }}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Update <b>Student Strength</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Year</th>
                        <th>IT</th>
                        <th>MECH</th>
                        <th>E&TC</th>
                        <th>COMP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <select class="form-control standard" name="year">
                                @foreach ($years as $standard)
                                    <option value="{{$standard->year}}">{{$standard->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="it" name="it" placeholder="Enter" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="mech" name="mech" placeholder="Enter" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="entc" name="entc" placeholder="Enter" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="comp" name="comp" placeholder="Enter" required>
                        </td>
                    </tr>      
                </tbody>
            </table>
            <div class="text-right">
                    <button type="submit" class="btn btn-info"> Update Strength</button>
            </div>
        </form>
    <br>
</div>
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection