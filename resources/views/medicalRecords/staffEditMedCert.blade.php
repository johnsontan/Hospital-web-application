@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center mb-5">
        <h1 class="text-center">Edit Medical Cert</h1>
    </div>

  
    <form name="editMedCertForm"  action="/editMedCert/{{$medCert->certID}}" method="POST">
    @csrf
    @method('patch')
    <div class="row d-flex justify-content-center">
        <div class="col-sm-4 mb-3">
            <label for="apptID" class="form-label">Appointment ID</label>
            <input class="form-control" type="text"  name="appID" value="{{$medCert->apptID}}" aria-label="apptID" readonly>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-4 mb-3">
            Start Date
            <input id="startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" name="startDate" value="{{$medCert->startDate}}" required autocomplete="startDate">
            @error('startDate')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror         
        </div>

        <div class="col-sm-4 mb-3">
            Duration
            <input type="number"  min = "0" name="duration" class="form-control" id="duration" aria-describedby="duration"  value="{{$medCert->durationInDays}}"> 
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
            <textarea name="remarks" class="form-control" id="remarks" rows="3" >{{$medCert->remarks}}</textarea>
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
