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
    {{--
     <div class="row">
        <div class="col-sm-3 col-lg-3 col-md-3"></div>
        <div class="col-sm-6 col-lg-6 col-md-6">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12 col-lg-12 col-md-12"><h2><b>Hostel Reference Table</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Hostel Name</th>
                        <th>Hostel ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hostelnames as $hostelname)
                    <tr><td>{{ $loop->index + 1 }}</td>
                        <td>{{ $hostelname->hostelname}}</td>
                        <td><b>{{ $hostelname->hostel_id}}</b></td>
                    </tr>
                    @endforeach      
                </tbody>
            </table>dg
            </div>
        </div>
    </div>
    <br>
    --}}
        <div class="table-wrapper">
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
            @endif
            {{-- Hostel Alloted Yearwise --}}
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Year wise <b>Hostel Alloted</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Year</th>
                        <th>Hostels</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($years as $standard)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $standard->name}} </td>
                            <td>
                                @if(!$hostelalloted[$standard->year]->isEmpty())
                                    @foreach($hostelalloted[$standard->year] as $hotels)
                                        <b>{{$hotels->hostelname.",  " }}</b>
                                    @endforeach
                                @else
                                    No Hostel Alloted.
                                @endif
                            </td>
                            <td>  
                                @if(!$hostelalloted[$standard->year]->isEmpty())
                                    <a class="btn btn-danger" href = 'managehostels/{{$hotels->hostel_id}}/edit'>Delete</a>
                                @else
                                    __/^^\__
                                @endif
                            </td>
                        </tr> 
                    @endforeach    
                </tbody>
            </table>

            {{--
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Year wise <b>Hostel Planning</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Year</th>
                        <th>Hostel 1</th>
                        <th>Hostel 2</th>
                        <th>Hostel 3</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hostel as $hostel)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                @if($hostel->year == '1')
                                FE
                                @elseif($hostel->year == '2')
                                SE
                                @elseif($hostel->year == '3')
                                TE
                                @elseif($hostel->year== '4')
                                BE
                                @else
                                Error
                                @endif
                            </td>
                            <td>
                                @if($hostel->hostel1 == '0')
                                None
                                @else
                                <b>{{$hostel->hostelname1->hostelname}}</b>
                                @endif
                            </td>
                            <td>
                                @if($hostel->hostel2 == '0')
                                None
                                @else
                                <b>{{$hostel->hostelname2->hostelname}}</b>
                                @endif
                            </td>
                            <td>
                                @if($hostel->hostel3 == '0')
                                None
                                @else
                                <b>{{$hostel->hostelname3->hostelname}}</b>
                                @endif
                            </td>

                        <td>
                            {{ Form::open(['method' => 'DELETE', 'route' => ['managehostels.destroy', $hostel->year]]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                        </tr> 
                    @endforeach    
                </tbody>
            </table>
            --}}
        </div>
        <br>

        <form role="form" action="{{ route('hostelalloted') }}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Set <b>Hostel Choices</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Year</th>
                        <th>Hostel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <select class="form-control standard" name="standard">
                                @foreach ($years as $standard)
                                    <option value="{{$standard->year}}">{{$standard->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control hostel" name="hostel">
                                @foreach($hostelnames as $hostelname)
                                    <option value="{{$hostelname->hostel_id}}">{{ $hostelname->hostelname}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>      
                </tbody>
            </table>
            <div class="text-right">
                    <button type="submit" class="btn btn-info"> Allot Selected Hostel</button>
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