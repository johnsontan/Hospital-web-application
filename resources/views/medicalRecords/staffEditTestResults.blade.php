@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center mb-5">
        <h1 class="text-center">Edit Test Results</h1>
    </div>


    <form name="editTestResultForm"  action="/editTestResult/{{$testResult->trID}}" method="POST">
    <div class="row d-flex justify-content-center">
    @csrf
    @method('patch')
    <div class="row d-flex justify-content-center">
        <div class="col-sm-4 mb-3">
            <label for="apptID" class="form-label">Appointment ID</label>
            <input class="form-control" type="text"  name="appID" value="{{$testResult->apptID}}" aria-label="apptID" readonly>
        </div>
    </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-8 mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control" id="remarks" rows="3">{{$testResult->content}}</textarea>
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
