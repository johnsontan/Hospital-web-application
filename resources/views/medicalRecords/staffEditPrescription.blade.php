@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center mb-5">
        <h1 class="text-center">Edit Prescriptions</h1>
    </div>


    <form name="editPrescriptionForm"  action="/editPrescription/{{$prescriptions->first()->health_record_id}}" method="POST">
    @csrf
    @method('patch')
    <div class="row d-flex justify-content-center">
        <div class="col-sm-4 mb-5">
            <label for="apptID" class="form-label">Appointment ID</label>
            <input class="form-control" type="text" name="appID" value="{{$prescriptions->first()->apptID}}" aria-label="apptID" readonly>
        </div>
    </div>

        <table class="table overflow-auto" id="medTable">
            <tr>
                <th>Select Medication</th>
                <th>Enter Quantity</th>
                <th><input type="button" class="btn btn-block btn-outline-primary" id="addrow" onclick="addRow()" value="Add new row +" /></th>
            </tr>
           
             
                    @foreach ($prescriptions as $prescription)
                    <tr>
                        <td>
                            <select name="medication_name[]" class="form-control" medication_name>
                            @if (isset($medications))
                            @foreach ($medications as $medication)
                            @if ($prescription->medicationName == $medication->medicationName)
                                 <option value="{{$medication->id}}" selected>{{$medication->medicationName}}</option>;
                            @else
                                <option value="{{$medication->id}}">{{$medication->medicationName}}</option>;
                            @endif
                            @endforeach
                            @endif
                            </select>
                        </td>
                        <td><input type="number" min="0" name="medication_quantity[]" class="form-control medication_quantity" value="{{$prescription->quantity}}"/></td>
                        <th><input type="button" class="btn btn-block btn-outline-danger" id="deleterow" onclick="deleteRow(this)" value="Delete row -" /></th>
                    </tr>
                    @endforeach
                  
                     
            
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




