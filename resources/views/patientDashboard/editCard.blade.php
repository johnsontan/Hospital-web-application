@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Add a card</h2>
                    <span class="fw-bold">[{{ Auth::user() ? Auth::user()->profile->name : 'NIL' }}]</span>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('patient.update', ['patient' => Auth::user()->patient->id ]) }}" class="mt-5">
                        @csrf
                        @method('PATCH')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->patient->cardHolderName ? Auth::user()->patient->cardHolderName : old('name') }}" required autocomplete="name" placeholder="E.g John Smith" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="creditCardNum" class="col-md-4 col-form-label text-md-right">{{ __('Credit card number') }}</label>

                            <div class="col-md-6">
                                <input id="creditCardNum" type="text" class="form-control @error('creditCardNum') is-invalid @enderror" name="creditCardNum" value="{{ Auth::user()->patient->creditCardNum ? Auth::user()->patient->creditCardNum : old('creditCardNum') }}" required autocomplete="creditCardNum" placeholder="16 digit number" pattern="[0-9]{16}">

                                @error('creditCardNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cvv" class="col-md-4 col-form-label text-md-right">{{ __('CVV') }}</label>

                            <div class="col-md-6">
                                <input id="cvv" type="text" class="form-control @error('cvv') is-invalid @enderror" name="cvv" value="{{ Auth::user()->patient->cvv ? Auth::user()->patient->cvv : old('cvv') }}" required autocomplete="cvv" placeholder="3 digit number" pattern="[0-9]{3}">

                                @error('cvv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="expDate" class="col-md-4 col-form-label text-md-right">{{ __('Expiry date') }}</label>

                            <div class="col-md-6">
                                <input id="expDate" type="text" class="form-control @error('expDate') is-invalid @enderror" name="expDate" value="{{ $mmyy ? $mmyy :  old('expDate') }}" required autocomplete="expDate" placeholder="MM/YY" pattern="(?:0[1-9]|1[0-2])/2[1-9]{1}">

                                @error('expDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

        
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save card') }}
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