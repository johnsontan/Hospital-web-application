@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3"><h5>STAFF: [{{ Auth::user()->name }}]</h5></div>
    <div class="row d-flex justify-content-evenly mt-3 pb-3">

        <a class="btn btn-primary col-4" data-bs-toggle="collapse" href="#upcoming" role="button" aria-expanded="false" aria-controls="upcoming">
            Upcoming appointments
        </a>    
        <a class="btn btn-info col-4" data-bs-toggle="collapse" href="#past" role="button" aria-expanded="false" aria-controls="past">
            Past appointments
        </a>   
        <div class="collapse mt-3" id="upcoming">
            <div class="card card-body overflow-auto">
                <h4>Upcoming appointments</h4>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Patient</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Location</th>
                        <th scope="col">Treatment</th>
                        <th scope="col">More options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($upcomingApp->isNotEmpty())
                            @foreach ($upcomingApp as $app)
                                <tr>
                                    <td>{{$app->patient->user->name}}</td>
                                    <td>{{ $app->appDate }}</td>
                                    <td>
                                        @switch($app->appTime)
                                            @case(0)
                                                0900HRS - 10000HRS
                                                @break
                                            @case(1)
                                                1000HRS - 11000HRS
                                                @break
                                            @case(2)
                                                1100HRS - 12000HRS
                                                @break
                                            @case(3)
                                                1300HRS - 14000HRS
                                                @break
                                            @case(4)
                                                1400HRS - 15000HRS
                                                @break
                                            @case(5)
                                                1500HRS - 16000HRS
                                                @break
                                            @default
                                                No Info
                                                @break                                                
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($app->referral)
                                            Other location
                                        @else
                                            Hospsech
                                        @endif
                                    </td>
                                    <td>{{ $app->treatment->treatmentTitle }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('staffApp.edit', ['appointment' => $app->id]) }}" class="btn btn-secondary mr-2">Edit</a>
                                        <form action="{{ route('bookApp.destory', ["appointment" => $app->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>  
                            @endforeach                              
                        @else
                            <tr>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                            </tr>  
                        @endif
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="collapse mt-3" id="past">
            <div class="card card-body overflow-auto">
                <table class="table">
                    <h4>Past appointments</h4>
                    <thead>
                      <tr>
                        <th scope="col">Patient</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Location</th>
                        <th scope="col">Treatment</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($pastApp->isNotEmpty())
                            @foreach ($pastApp as $app)
                                <tr>
                                    <td>{{$app->patient->user->name}}</td>
                                    <td>{{ $app->appDate }}</td>
                                    <td>
                                        @switch($app->appDate)
                                            @case(0)
                                                0900HRS - 10000HRS
                                                @break
                                            @case(1)
                                                1000HRS - 11000HRS
                                                @break
                                            @case(2)
                                                1100HRS - 12000HRS
                                                @break
                                            @case(3)
                                                1300HRS - 14000HRS
                                                @break
                                            @case(4)
                                                1400HRS - 15000HRS
                                                @break
                                            @case(5)
                                                1500HRS - 16000HRS
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
                                    <td>{{ $app->treatment->treatmentTitle }}</td>
                                    <td>
                                        {{$app->status}}
                                    </td>
                                </tr>  
                            @endforeach                              
                        @else
                            <tr>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                            </tr>  
                        @endif                     
                    </tbody>
                  </table>
            </div>
        </div>

    </div>
    
</div>

@endsection