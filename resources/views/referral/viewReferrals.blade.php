@extends('layouts.app')

@section('content')
            <div class="container pt-5">
                <div class="mb-5 row justify-content-center">
                    <h1 class="text-center">View Referrals</h1>
                </div>
            </div>
            <div class="container my-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Referral Code</th>
                            <th scope="col">Appointment ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Memo</th>
                            <th scope="col">Accept/Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($referral->isNotEmpty())
                        @foreach($referral as $referral)
                        <tr>
                            <th scope="row">{{$referral->id}}</th>
                            <td>{{$referral->appointment_id}}</td>
                            <td>{{$referral->referralDate}}</td>
                            <td>
                                @switch($referral->requestedTime)
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
                            <td>{{$referral->memo}}</td>
                            <td> 
                                <!-- <p><a href="#" class="btn btn-info btn-lg">
                                <span class=""></span>ACCEPT
                                </a> 
                                <a href="#" class="btn btn-info btn-lg">
                                <span class=""></span> REJECT
                                </a>
                                </p> -->
                                <p><form action="{{ route('referral.accept', ['referral' => $referral->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to accept this referral?');">
                                    @csrf
                                    <button class="btn btn-info btn-lg" type="submit">ACCEPT</button>
                                </form></p>
                                <p><form action="{{ route('referral.reject', ['referral' => $referral->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this referral?');">
                                    @csrf
                                    <button class="btn btn-danger btn-lg" type="submit">REJECT</button>
                                </form></p>
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
@endsection 