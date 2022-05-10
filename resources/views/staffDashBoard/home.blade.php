@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Your Dashboard</h1>
                </div>

                <div class="panel-body mb-5">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello {{ $user->profile->name }}, what would you like to do today?
                </div>
            </div>
        </div>
    </div>
</div>
                
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-8">
            <div class="row d-flex justify-content-evenly">
                @if(Auth::user()->hasRole('doctor'))
                    <div class="col-sm-4 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('availtimeslot.index') }}" type="button">
                            Manage Timeslots
                        </a>
                    </div>
                @endif
                                
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('staffApp.view', ["ms" => Auth::user()->medicalStaff->id])}}" type="button">
                        
                        My Appointments
                    </a>
                </div>
            </div>
                
            <div class="row d-flex justify-content-evenly">
                @if(Auth::user()->hasRole('doctor'))
                    <div class="col-sm-4 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('medicalRecords.displayCreatePage') }}" type="button">
                            Create Health Records
                        </a>
                    </div>
                @endif
                                    
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('medicalRecords.viewMedicalRecords') }}" type="button">
                        View Patient Health Records
                    </a>
                </div>
            </div>

            <div class="row d-flex justify-content-evenly">
                @if(Auth::user()->hasRole('doctor'))
                    <div class="col-sm-4 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 btn-block d-flex justify-content-evenly" href="{{ route('referral') }}" type="button">
                            Refer a Patient
                        </a>
                    </div>
                @endif

                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 btn-block d-flex justify-content-evenly" href="{{ route('staff.consult') }}" type="button">
                        Consult a patient
                    </a>
                </div>
            </div>
            @if(Auth::user()->hasRole('doctor'))
                <div class="row d-flex justify-content-evenly">
                    <div class="col-sm-4 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('referral.view') }}" type="button">
                            View Referrals
                        </a>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('commonservices.index') }}" type="button">
                            Book Common Services
                        </a>
                    </div>
                </div>
            @endif
            
        </div>

        <div class="col-sm-4">
            <div class="row">
                <h2 class="text-decoration-underline text-center">Upcoming Appointments</h2>
            </div>

            <div class="row border border-primary rounded-3 overflow-auto mh-100">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($upcomingApp->isNotEmpty())
                            @foreach ($upcomingApp as $app)
                                <tr class="align-top">
                                    <td>{{$app->appDate}}</td>
                                    <td>
                                        @switch($app->appTime)
                                            @case(0)
                                                0900HRS - 1000HRS
                                                @break
                                            @case(1)
                                                1000HRS - 1100HRS
                                                @break
                                            @case(2)
                                                1100HRS - 1200HRS
                                                @break
                                            @case(3)
                                                1300HRS - 1400HRS
                                                @break
                                            @case(4)
                                                1400HRS - 1500HRS
                                                @break
                                            @case(5)
                                                1500HRS - 1600HRS
                                                @break
                                            @default
                                                No Info
                                                @break                                                
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($app->referral)
                                            @if($app->referral->location_id)
                                                {{$app->referral->location->hospitalName}}
                                            @else
                                                Hospsech | {{$app->referral->medicalStaff->department->departmentName}}
                                            @endif
                                        @else
                                            Hospsech
                                        @endif
                                    </td>
                                    <td>{{$app->status}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>No Info</td>
                                <td>No Info</td>
                                <td>No Info</td>
                                <td>No Info</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

       
    </div>
    
</div>

@endsection 