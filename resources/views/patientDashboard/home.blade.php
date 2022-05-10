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
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('bookApp.index') }}" type="button">
                        Book New Appointment
                    </a>
                </div>
                                
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('patient.displayDocInfoSearch') }}" type="button">
                        Search For Doctor
                    </a>
                </div>
            </div>
                
            <div class="row d-flex justify-content-evenly">
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{route('bookApp.view', ['user' => Auth::user()->id])}}" type="button">
                        View All Appointments
                     </a>
                </div>
                                    
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('searchCondition') }}" type="button">
                        Search Health Conditions
                    </a>
                </div>
            </div>

            <div class="row d-flex justify-content-evenly">
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('2fa.index') }}" id="healthR" type="button">
                        My Health Records
                    </a>
                    <input type="text" value="medicalRecords.viewMedicalRecords" id="nextRHealth" hidden readonly>
                </div>

                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{route('payment.index', ['user' => Auth::user()->id])}}" type="button">
                        Payment
                    </a>
                </div>  
            </div>

            <div class="row d-flex justify-content-evenly">
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('eduMaterial.search') }}" type="button">
                        View Educational Information
                    </a>
                </div>
                <div class="col-sm-4 mb-3">
                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('referral.view') }}" type="button">
                        View Referrals
                    </a>
                </div>  
            </div>
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
<script>
    $("#healthR").mouseover(function(){
        $.ajax({
            url: "{{ route('2fa.setVar') }}?nextR=" + $("#nextRHealth").val(),
            method: 'GET',
            success: function(result) {                
                //console.log(result.success);
            }
        });
    });
</script>
@endsection 