@extends('layouts.app')

@section('content')
    <meta name="_token" content="{{csrf_token()}}" />

    <div class="container justify-content-center align-items-center d-flex mt-5">
        <h1 class="text-center mx-5">Edit an appointment</h1>
    
        <form action="{{route('bookApp.update', ["appointment" => $app->id])}}" method="post" class="col-8 bg-info p-2">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="treatment" class="fw-bold mt-3 mb-2">Treatment</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="treatment_id" id="treatment" class="form-select" real>
                        @if($treatment)
                            <option value="{{ $treatment->id }}">{{$treatment->treatmentTitle}}</option>
                        @else

                        @endif
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="medicalStaff" class="fw-bold mt-2 mb-2">Doctor</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="medicalStaff" id="medicalStaff" class="form-select">
                        <option value=""></option>
                        <option value="{{ $doctor->id }}">{{$doctor->user->name}}</option>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="date" class="fw-bold mt-2 mb-2">Date</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="date" id="date" class="form-select">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="time" class="fw-bold mt-2 mb-2">Time</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="time" id="time" class="form-select">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary mt-3 col-12">Book appointment</button>
        </form>
        
    </div>

<script>
    $("#medicalStaff").change(function(){
        $.ajax({
            url: "{{ route('bookApp.ms') }}?ms=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                $('#date').html(result.ats);
            }
        });
    });

    $("#date").change(function(){
        let myArray = $(this).val().split("|");
        $.ajax({
            url: "{{ route('bookApp.date') }}?ms=" + myArray[0] + "&date=" + myArray[1] ,
            method: 'GET',
            success: function(result) {
                $('#time').html(result.blockNum);
            }
        });
    });
</script>
@endsection