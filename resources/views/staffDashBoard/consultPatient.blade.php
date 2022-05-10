@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">        
        <h4>Consult patient</h4>
        <h5><?php echo date('Y-m-d') ?></h5>
    </div>
    <form action="{{ route('staff.updateStatus')}}" method="post" class="mt-5">
        @csrf
        @method('PATCH')
        <div class="row text-center overflow-auto">
            <label for="appointment" class="h5">Patient</label>                    
        </div>
        <div class="row mt-2 overflow-auto">
            <label for="appointment">Select appointment</label>
            <select name="appointment" id="appointment">
                <option value=""></option> 
                @if($appointments->isNotEmpty())
                    @foreach ($appointments as $app)
                        @switch($app->appTime)
                            @case(0)
                                <option value="{{ $app->id }}">{{ $app->patient->user->name }} | 0900HRS to 1000HRS</option>
                                @break
                            @case(1)
                                <option value="{{ $app->id }}">{{ $app->patient->user->name }} | 1000HRS to 1100HRS</option>
                                @break
                            @case(2)
                                <option value="{{ $app->id }}">{{ $app->patient->user->name }} | 1100HRS to 1200HRS</option>
                                @break
                            @case(3)
                                <option value="{{ $app->id }}">{{ $app->patient->user->name }} | 1300HRS to 1400HRS</option>
                                @break
                            @case(4)
                                <option value="{{ $app->id }}">{{ $app->patient->user->name }} | 1400HRS to 1500HRS</option>
                                @break
                            @case(5)
                                <option value="{{ $app->id }}">{{ $app->patient->user->name }} | 1500HRS to 1600HRS</option>
                                @break
                            @default
                                <option value="{{ $app->id }}">{{ $app->patient->user->name }}</option>
                                @break
                        @endswitch
                    @endforeach
                @endif
            </select>                  
        </div>
        <div class="row mt-2 overflow-auto">
            <label for="bookApp">Follow up appointment</label>
            <select name="bookApp" id="bookApp">
                <option value=""></option> 
                
            </select>                  
        </div>
        @if(Auth::user()->hasRole('doctor'))
            <div class="row mt-2 overflow-auto">
                <label for="treatment">Require further treatment</label>
                <select name="treatment" id="treatment">
                    <option value=""></option> 
                    @if($treamtents)
                        @foreach ($treamtents as $t)
                            <option value="{{$t->id}}">{{$t->treatmentTitle}}</option>                        
                        @endforeach
                    @endif
                </select>                  
            </div>
        @endif
        @if(Auth::user()->hasRole('doctor'))
            <div class="row my-3">
                <div class="col-lg-6 col-12 p-2">
                    <label for="prescription">Prescription</label>
                    <table class="table overflow-auto" id="medTable">
                        <tr>
                            <th>Select Medication</th>
                            <th>Enter Quantity</th>
                        </tr>
                        
                        <tr>
                            <td><select name="medication_name[]" class="form-control" medication_name>
                            @if (isset($medications))
                                @foreach ($medications as $medication)
                                <option value="{{$medication->id}}">{{$medication->medicationName}}</option>
                                @endforeach
                            @endif
                            </select></td>
                            <td><input type="number" min="0" name="medication_quantity[]" class="form-control medication_quantity")/></td>
                            <th><input type="button" class="btn btn-block btn-outline-primary" id="addrow" onclick="addRow()" value="Add new row +" /></th>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 col-12 p-2">
                    <p>E-medical certificate</p>                 
                    <label for="duration">Duration in days</label>
                    <input type="number"  min = "0" name="duration" class="form-control" id="duration" aria-describedby="duration" value="{{ old('duration') }}" > 
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea name="remarks" class="form-control" id="remarks" rows="3" >{{ old('remarks') }}</textarea>
                </div>
            </div>
        @endif
        <div class="row my-2">
            <label for="memo">Memo</label>
            <textarea name="memo" id="memo" cols="50" rows="18"></textarea>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary col-12 mt-2">Consult</button>
        </div>
    </form>
    <div class="row mt-5">
        <h5 class="text-center">Appointment information</h5>
    </div>
    <div class="row mt-2 overflow-auto">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Patient name</th>
                <th scope="col">Treatment</th>
                <th scope="col">Department</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody name="displayRec" id="displayRec">
            <tr>
                <td>No info</td>
                <td>No info</td>
                <td>No info</td>
                <td>No info</td>
                <td>No info</td>
                <td>No info</td>
            </tr>          
            </tbody>
        </table>
    </div>


    <div class="row mt-5">
        <h5 class="text-center">Patient's history</h5>
    </div>
    <div class="row mt-2 overflow-auto mb-3">
        <table class="table">
            <thead>
            <tr>                
                <th scope="col">Treatment</th>
                <th scope="col">Department</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Options</th>
            </tr>
            </thead>
            <tbody name="displayHis" id="displayHis">
            <tr>                
                <td>No info</td>
                <td>No info</td>
                <td>No info</td>
                <td>No info</td>
                <td>No info</td>
            </tr>          
            </tbody>
        </table>
    </div>
    <div class="displaymemo" id="displaymemo">

    </div>
</div>
<script>
    $("#appointment").change(function(){
        $.ajax({
            url: "{{ route('staff.appointment') }}?appID=" + $(this).val(),
            method: 'GET',
            success: function(result) {   
                //console.log(result.patientHistory);             
                $('#displayRec').html(result.appRec);
                $('#memo').html(result.appMemo);
                $('#bookApp').html(result.msTS);
                $('#displayHis').html(result.patientHistory);
                $('#displaymemo').html(result.patientHistorym);
            }
        });
    });

    function addRow()
    {
        var html = '';
        html += '<tr>';
        html += '<td><select name="medication_name[]" class="form-control" medication_name>'; 
            @if (isset($medications))
            @foreach ($medications as $medication)
            html += '<option value="{{$medication->id}}">{{$medication->medicationName}}</option>';
            @endforeach
            @endif
        html += '</select></td>';
        html += '<td><input type="number" min="0" name="medication_quantity[]" class="form-control medication_quantity")/></td>';
        html += '<th><input type="button" class="btn btn-block btn-outline-danger" id="deleterow" onclick="deleteRow(this)" value="Delete row -" /></th></tr>';
        $('#medTable').append(html);
    }

    function deleteRow(t)
    {
        var row = t.parentNode.parentNode;
        document.getElementById("medTable").deleteRow(row.rowIndex);
        console.log(row);
    }

    
</script>
@endsection