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

    <!-- Display mesage if medical record is sucessfully edited/deleted -->
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    @if (isset ($medicalRecord))
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-menu-app"> Appointment ID</i></span>
            <input id="" class="form-control" name="" value="{{$medicalRecord->appointment_id}}" readonly>
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person-bounding-box"> Patient</i></span>
            <input id="" type="text" class="form-control" name="" value="{{$medicalRecord->name}}" readonly>
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-calendar-check-fill"> Date</i></span>
            <input id="" type="text" class="form-control" name="" value="{{$medicalRecord->created_at->toDateString()}}" readonly>
        </div>
       
            </br>
                    <!-- Display prescription -->
                    </br><label for="Prescription" class="font-weight-bold">Prescription:</label>
                    <!--Have to check the variable like this, if not code will have error due to the destroy method being different -->
                    @if (isset($prescriptions->first()->quantity))
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Medication Name</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prescriptions as $prescription)
                            <tr>
                                <td scope="row" class="align-middle">{{$prescription->medicationName}}</td>
                                <td class="align-middle">{{$prescription->quantity}}</td>
                            </tr>
                            @endforeach       
                        </tbody>
                     </table> 
                     
                      <!-- buttons to edit and delete prescription -->                             
                    <form  name = "deletePrescriptionForm"action="{{route('medicalRecords.destroyPrescription')}}" method="post" onsubmit="return confirm('Are you sure you wish to delete?');">
                        <a href="/editPrescription/{{ $prescriptions->first()->health_record_id}}" class="btn btn-outline-primary btn-sm align-start" type="button">Edit</a>    
                        @csrf
                        @method('DELETE')
                        @foreach  ($prescriptions as $prescription)
                            <input type="hidden" name="prescriptionData[]"  value="{{$prescription->id}}">
                        @endforeach  
                        <input type="submit" class="btn btn-outline-primary btn-sm align-end" type="button" value="Delete">
                    </form>   
                    @else   
                        <textarea class="form-control" rows="1" id="comment" readonly>No prescriptions</textarea>                                      
                    @endif     
                    
                    
                
                    <!-- Display test results-->
                    </br><label for="TestResults" class="font-weight-bold mt-3">Test Results:</label>
                    @if (isset($testResults))
                    <textarea class="form-control" rows="4" id="TestResults" readonly>Content: {{$testResults->content}}</textarea>
                  

                    <!-- buttons to edit and delete test results -->
                    <div class="col-sm-4 justify-content-start mt-3">
                        <!-- link this to the edit TR function -->
                       
                        <form name = "deleteTestResultForm" action="{{ route('medicalRecords.destroyTestResult', ["record" => $testResults->id])}}" method="post" onsubmit="return confirm('Are you sure you wish to delete?');">
                            <a href="/editTestResult/{{ $testResults->id }}" class="btn btn-outline-primary btn-sm align-start" type="button">Edit</a> 
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-outline-primary btn-sm align-end" type="button" value="Delete"> 
                        </form>
                    </div>
                    @else
                    <textarea class="form-control" rows="4" id="TestResults" readonly>No test results</textarea>
                    @endif
                   
                    <!-- Display Medical certificate-->
                    <label for="comment" class="font-weight-bold mt-3">Medical Certificate:</label>
                    @if (isset($medCert))
                    <textarea class="form-control" rows="4" id="comment" readonly>Start date: {{$medCert->created_at->toDateString()}}&#13;&#10;Duration: {{$medCert->durationInDays}} day(s)&#13;&#10;Remarks:{{$medCert->remarks}}</textarea>
               
                   @if ($medicalRecord->status != "completed" && $medicalRecord->status != "paymentpending")
                        <!-- buttons for edit/delete MC -->
                        <div class="col-sm-4 justify-content-start mt-3">
                            <form name = "deleteMCForm" action="{{ route('medicalRecords.destroyCert', ["record" => $medCert->id])}}" method="post" onsubmit="return confirm('Are you sure you wish to delete?';)">
                                <a href="/editMedCert/{{ $medCert->id }}" class="btn btn-outline-primary btn-sm align-start" type="button">Edit</a>
                                @csrf
                                @method('DELETE')  
                                <input type="submit" class="btn btn-outline-primary btn-sm align-end" type="button" value="Delete">
                            </form> 
                        </div> 
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
                    @else
                    <textarea class="form-control" rows="4" id="comment" readonly>No medical certificate</textarea>
                    @endif
        @endif
    </div>
@endsection 