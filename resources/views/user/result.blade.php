@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Allotment Result</div>
               
                <div class="card-body">
                    @if ($result))
                        <div class="alert alert-success">
                            <strong>Results are Out. Check in your Profile.</strong>
                        </div>
                    @else
                        <strong>Your Application has been submitted successfully. You will be shortly notified about the allotment result.</strong>
                        <p class="text-center"> Thank You.</p><div class="text-center">
                            <a href="{{ route('applicationpdf', array('id' => $application->regno)) }}" target="_blank" class="btn btn-danger">Download Your Application as PDF</a>
                        </div>
                        <p class="float-right"> Regards- Administration AIT</p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection