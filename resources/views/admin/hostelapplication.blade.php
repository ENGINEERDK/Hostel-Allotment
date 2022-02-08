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
    </h1>
  <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Hostel <b>Applications</b></h2></div>
                    <div class="col-sm-2"><a href="{{route('allotment', array('year' => $id)) }}" class="btn btn-success"> Allot Rooms</a></div>
                    <div class="col-sm-2 text-right"><a href="{{ route('application.edit', array('id' => $id)) }}" class="btn btn-danger">Delete Applications</a></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Reg No</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Year & Branch</th>
                        <th>Marks</th>
                        <th>Hostel Preferences</th>
                        <th>Floor Preferences</th>
                        <th>Room Preferences</th>
                        <th>Roommate Preferences</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                    <tr>
                        <td>{{ $loop->index + 1 }}
                            {{ Form::open(['method' => 'DELETE', 'route' => ['application.destroy', $application->id]]) }}
                                {{ Form::submit('X', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                        <td>{{$application->regno}}</td>
                        <td>{{$application->rollno}}</td>
                        <td>{{$application->name}}</td>
                        <td>{{$application->studentyear->name}} {{$application->studentbranch->name}}
                        </td>
                        <td>{{$application->marks}}</td>
                        <td><ol>
                                @if($application->hostel_pref1)
                                <li>
                                    <b>{{$application->hostelpref1->hostelname}}</b>
                                </li>
                                @endif
                                
                                @if($application->hostel_pref2)
                                <li>
                                    <b>{{$application->hostelpref2->hostelname}}</b>
                                </li>
                                @endif
                                
                                @if($application->hostel_pref3)
                                <li>
                                    <b>{{$application->hostelpref3->hostelname}}</b>
                                </li>
                                @endif
                                
                                @if($application->hostel_pref4)
                                <li>
                                    <b>{{$application->hostelpref4->hostelname}}</b>
                                </li>
                                @endif
                            </ol>
                        </td>
                        <td><ol><li> {{$application->floorpref1->name}} </li>
                                <li> {{$application->floorpref2->name}} </li>
                                <li> {{$application->floorpref3->name}} </li>
                                <li> {{$application->floorpref4->name}}</li>
                            </ol>
                        </td>
                        <td><ol><li> {{$application->roompref1->name}} </li>
                                <li> {{$application->roompref2->name}} </li>
                                <li> {{$application->roompref3->name}}</li>
                                <li> {{$application->roompref4->name}}</li>
                            </ol>
                        </td>
                        <td><ol><li>{{$application->mate1}}</li><li>{{$application->mate2}}</li><li>{{$application->mate3}}</li><li></li></ol></td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
            <div style="text-align:center;">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script src="{{ asset('js/addhostelroom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection