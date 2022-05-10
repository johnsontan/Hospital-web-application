@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading mb-4">Billing</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!is_null($patient->cardHolderName))
                        <div>
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h3 class="card-title">Credit card</h3>
                                    <h5>Name: {{ $patient->cardHolderName }}</h5>
                                    <p>**** **** **** {{ substr($patient->creditCardNum, 12, 16) }}</p>
                                    <div class="d-grid gap-2">
                                        <a href="/profile/billing/{{ $patient->id }}/edit" class="btn btn-primary">Edit</a>
                                        <form method="POST" action="{{ route('patient.destory', ["patient" => $patient->id])}}" onSubmit="return confirm('Are you sure you wish to delete?');">
                                            @csrf
                                            @method('DELETE')
                                    
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger col-12" type="button" value="Delete">
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    @else
                        <a href="{{ route('patient.create') }}" class="btn btn-primary btn-lg">Add a card</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 