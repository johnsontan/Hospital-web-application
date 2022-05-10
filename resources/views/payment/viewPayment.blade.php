@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3"><h5>PATIENT: [{{ Auth::user()->name }}]</h5></div>
    <div class="row d-flex justify-content-evenly mt-3 pb-3">

        <a class="btn btn-primary col-4" data-bs-toggle="collapse" href="#upcoming" role="button" aria-expanded="false" aria-controls="upcoming">
            Outstanding payments
        </a>    
        <a class="btn btn-info col-4" data-bs-toggle="collapse" href="#past" role="button" aria-expanded="false" aria-controls="past">
            Completed payments
        </a>   
        <div class="collapse mt-3" id="upcoming">
            <div class="card card-body overflow-auto">
                <h4>Outstanding payments</h4>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Location</th>
                        <th scope="col">Treatment</th>
                        <th scope="col">Status</th>
                        <th scope="col">More options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($paymentConsulted->isNotEmpty())
                            @foreach ($paymentConsulted as $app)
                                <tr>
                                    <td>{{ $app->appDate }}</td>
                                    <td>
                                        @switch($app->appTime)
                                            @case(0)
                                                0900HR - 1000HR
                                                @break
                                            @case(1)
                                                1000HR - 1100HR
                                                @break
                                            @case(2)
                                                1100HR - 1200HR
                                                @break
                                            @case(3)
                                                1300HR - 1400HR
                                                @break
                                            @case(4)
                                                1400HR - 1500HR
                                                @break
                                            @case(5)
                                                1500HR - 1600HR
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
                                    @if($app->status == "paymentpending")
                                        <td> Payment pending </td>
                                        <td>No info</td>
                                    @else
                                        <td>Consulted</td>
                                        <td class="d-flex">
                                            <a href="{{ route('payment.invoice', ['app' => $app->id]) }}" class="btn btn-primary mr-2">Make payment</a>                                        
                                        </td>
                                    @endif                                   
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
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Treatment</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($paymentCompleted->isNotEmpty())
                            @foreach ($paymentCompleted as $app)
                                <tr>
                                    <td>{{ $app->appDate }}</td>
                                   
                                    <td>
                                        @if($app->referral)
                                            Other location
                                        @else
                                            Hospsech
                                        @endif
                                    </td>

                                    <td>{{ $app->treatment->treatmentTitle }}</td>
                                    
                                    <td>
                                        Paid
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
                            </tr>  
                        @endif                     
                    </tbody>
                  </table>
            </div>
        </div>

    </div>
    
</div>
@endsection