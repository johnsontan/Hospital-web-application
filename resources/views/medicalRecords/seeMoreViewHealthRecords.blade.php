@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center mb-3">MY HEALTH RECORDS<h1> 
    </div>
    <div class="container my-4">
        <!-- <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Appointment ID</th>
                    <th scope="col">Doctor/Nurse</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">X</th>
                    <td>DD/MM/YYYY</td>
                    <td>.......</td>
                </tr>
            </tbody>
        </table> -->
    @if (isset ($medicalRecord))
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-menu-app"> Appointment ID</i></span>
            <input id="" class="form-control" name="" value="{{$medicalRecord->appointment_id}}" readonly>
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person-bounding-box"> Doctor/Nurse</i></span>
            <input id="" type="text" class="form-control" name="" value="{{$medicalRecord->name}}" readonly>
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-calendar-check-fill"> Date</i></span>
            <input id="" type="text" class="form-control" name="" value="{{$medicalRecord->created_at->toDateString()}}" readonly>
        </div>
        <form>
            </br>
            <div class="form-group">

                    </br><label for="Prescription" class="font-weight-bold">Prescription:</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Medication Name</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($prescriptions))
                            @foreach ($prescriptions as $prescription)
                            <tr>
                                <td scope="row" class="align-middle">{{$prescription->medicationName}}</td>
                                <td class="align-middle">{{$prescription->quantity}}</td>
                            </tr>
                            @endforeach
                            
                            @else
                            <tr class="align-middle">
                                <div class="alert alert-warning d-flex align-items-center mt-2" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                    No prescriptions
                                    </div>
                                </div>
                                @endif
                        </tbody>
                    </table>
            </div> 
                  
                    </br><label for="TestResults" class="font-weight-bold mt-3">Test Results:</label>
                    @if (isset($testResults))
                    <textarea class="form-control" rows="4" id="TestResults" readonly>Content: {{$testResults->content}}</textarea>
                    @else
                    <textarea class="form-control" rows="4" id="TestResults" readonly>No test results</textarea>
                    @endif

                    
            
            
                    <label for="comment" class="font-weight-bold mt-3">Medical Certificate:</label>
                    
                    @if (isset($medCert))
                    <textarea class="form-control" rows="4" id="comment" readonly>Start date: {{$medCert->created_at->toDateString()}}&#13;&#10;Duration: {{$medCert->durationInDays}} day(s)&#13;&#10;Remarks:{{$medCert->remarks}}</textarea>
               
                    @else
                    <textarea class="form-control" rows="4" id="comment" readonly>No medical certificate</textarea>
                    @endif
                    
                    <div class="mt-3">
                        <a href="/printMC/{{ $medCert->id }}"  type="button" class="btn btn-primary btn-sm" target="_blank">
                           
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"></path>
                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                            </svg>
                        Print MC
                        </a>
                    </div>

                </div>
            </div>
        </form>

        @endif
    </div>
   

@endsection 