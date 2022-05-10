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
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($referrals->isNotEmpty())
                        @foreach($referrals as $referral)
                        <tr>
                            <th scope="row">{{$referral->id}}</th>
                            <td>{{$referral->hospitalName}}</td>
                            <td>{{$referral->referralDate}}</td>
                            <td>{{$referral->referralTime}}</td>
                            <td><a href="{{route('referral.print', ['referral' => $referral->id ])}}"  type="button" target="_blank" class="btn btn-primary btn-bg">Print</td>
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