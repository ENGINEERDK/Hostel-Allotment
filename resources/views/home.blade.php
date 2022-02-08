@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Dashboard <small class="float-right"> [ Portal On Beta Mode. ]</small></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($result)
                        <div class="alert alert-success">
                            <strong class="text-center">Congratulations. You have been accomodated.</strong>
                        </div>
                        <table class="center-block">
                            <strong class="text-center"><h3>Allotment Result</h3></strong>
                            <tr>
                                <th><span>Your Name : </span></th>
                                <td><span>{{$result->name}}</span></td>
                            </tr>
                            <tr>
                                <th><span>Hostel : </span></th>
                                <td><span>{{$result->hostel->hostelname}}</span></td>
                            </tr>
                            <tr>
                                <th><span>Floor : </span></th>
                                <td><span>{{$result->floorname->name}}</span></td>
                            </tr>
                            <tr>
                                <th><span>Room Type : </span></th>
                                <td><span>{{$result->typeofroom->name}}</span></td>
                            </tr>
                            @if($result->roomtype != '1')
                            <tr>
                                <th><span>Bed No : </span></th>
                                <td><span>{{$result->bedno}}</span></td>
                            </tr>
                            @endif
                            <tr>
                                <th><span>Room No. </span></th>
                                <td><b><span>{{$result->roomno}}</span></b></td>
                            </tr>
                        </table>
                        <br>
                        <strong>Kindly give your valuable feedback and suggestions to help me to help you more.</strong>
                        <p class="text-center"> Thank You.</p>
                        <p class="float-right"> Regards- Administration AIT</p>
                    @elseif($application)
                        <strong>Your Application has been submitted successfully. You will be shortly notified about the allotment result.</strong>
                        <p class="text-center"> Thank You.</p>
                        <div class="text-center">
                            <a href="{{ route('applicationpdf', array('id' => $application->regno)) }}" target="_blank" class="btn btn-danger">Download Your Application as PDF</a>
                        </div>
                        <p class="float-right"> Regards- Administration AIT</p>
                    @else
                        <strong>Hostel Allotment Application is now available online through this Portal. Kindly proceed for the Hostel Application through below link. Select your preferences carefully.</strong>
                            <p class="text-center"> Thank You.</p>
                            <div class="text-center">
                                <a href="{{ route('application.index') }}" target="_blank" class="btn btn-success"><b>Hostel Application Form </b></a>
                            </div>
                            <p class="float-right"> Regards- Deepak Kumar Yadav</p>
                    @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
