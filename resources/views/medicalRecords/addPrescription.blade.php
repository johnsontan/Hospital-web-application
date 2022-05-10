@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center mb-5">
        <h1 class="text-center">Add new Prescriptions</h1>
    </div>


    <form name="addPrescriptionForm"  action="/addPrescription" method="POST">
    @csrf
    <div class="row d-flex justify-content-around">
        
        <div class="col-sm-4 mb-5">
            Appointment
            <select name="appID" id="appID" class="form-select form-select-md">                
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
        
            <div class="mb-3 form-check d-flex justify-content-center">
                <input type="checkbox" name="exampleCheck1" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">&nbspPlease confirm.</label>
            </div>
                @error('exampleCheck1')
                    <div class="text-danger d-flex justify-content-center">
                    </div>
                @enderror

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>

    <div class="text-danger d-flex justify-content-center mt-3">
        <div class="border border-0">
        @foreach ($errors->all() as $error)
                <li class="text-danger p-1">{{ $error }}</li>
        @endforeach 
        </div>
    </div>
    
</div>

<script>
   

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




