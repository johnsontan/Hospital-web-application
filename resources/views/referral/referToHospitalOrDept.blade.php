@extends('layouts.app')

@section('content')
            <div class="container pt-5">
                <div class="mb-5 row justify-content-center">
                    <h1 class="text-center">Patient Referrals</h1>
                </div>

                <div class="text-primary">
                    <div class="mb-5 text-center">
                        <a type="button" class="btn btn-primary btn-lg" href="{{ route('referral.hospital') }}">Refer Patient to Hospital</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a type="button" class="btn btn-primary btn-lg" href="{{ route('referral.department') }}">Refer Patient to Department</a>
                    </div>
                </div> 
            </div>
@endsection 