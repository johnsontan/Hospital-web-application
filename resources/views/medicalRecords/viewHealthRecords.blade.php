@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center mb-3">PATIENTS HEALTH RECORDS<h1> 
    </div>

    <div class="container my-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Appointment ID</th>
                    <th scope="col">Health Record ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                 <!-- Display existing health records-->
                @if (isset($medicalRecords))    
                @foreach($medicalRecords as $record) 
                <tr>
                    <td scope="row" class="align-middle">{{$record->appointment_id}}</td>
                    <td class="align-middle">{{$record->id}}</td>
                    <td class="align-middle">{{$record->created_at->toDateString()}}</td>
                    <td class="align-middle"><a href="/viewMoreMedicalRecords/{{ $record->id }}" class="btn btn-outline-primary btn-sm align-end" type="button">See More</a></td>    
                </tr>
                @endforeach
                @else
                  <!--Display no results found message -->
              <tr class="align-middle">
                <div class="alert alert-warning d-flex align-items-center mt-2" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      No results found
                    </div>
                @endif
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary btn-lg" href="{{ route('rolebased') }}" role="button">
                Back to dashboard
                
            </a>  
        </div>
    </div>
@endsection 