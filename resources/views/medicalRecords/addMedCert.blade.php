@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center mb-5">
        <h1 class="text-center">Add new Medical Cert</h1>
    </div>

 
    <form name="addMedCertForm"  action="/addMedCert" method="POST">
    @csrf
    <div class="row d-flex justify-content-center">
       

        <div class="col-sm-4 mb-3">
            Appointment
            <select name="appID" id="appID" class="form-select form-select-md">
                <option value=""></option>
                @if($allAppointments->isNotEmpty())
                    @foreach ($allAppointments as $app)
                        <option value="{{$app->id}}">{{$app->patient->user->name}} | {{$app->treatment->treatmentTitle}} | {{$app->appDate}}</option>
                    @endforeach
                @endif
            </select>
            @error('appID')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror         
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-4 mb-3">
            Start Date
            <input id="startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" name="startDate" value="{{ old('startDate') }}" required autocomplete="startDate">
            @error('startDate')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror         
        </div>

        <div class="col-sm-4 mb-3">
            Duration
            <input type="number"  min = "0" name="duration" class="form-control" id="duration" aria-describedby="duration" value="{{ old('duration') }}" > 
            @error('duration')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror        
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-8 mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control" id="remarks" rows="3" >{{ old('remarks') }}</textarea>
            @error('remarks')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
        
            <div class="mb-3 form-check d-flex justify-content-center">
                <input type="checkbox" name="exampleCheck1" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">&nbspPlease confirm.</label>
            </div>
                @error('exampleCheck1')
                    <div class="text-danger d-flex justify-content-center">
                        {{$message}}
                    </div>
                @enderror

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
   
</div>
@endsection
