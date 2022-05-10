@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email OTP') }}</div>

                <div class="card-body">
                    {{ __('An OTP has been sent to your email. Please confirm your OTP before continuing.') }}

                    <form method="POST" action="{{ route('2fa.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('OTP code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="code" pattern="[0-9]{4}">

                                @if(\Session::has('error'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! \Session::get('error') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm OTP') }}
                                </button>
    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
