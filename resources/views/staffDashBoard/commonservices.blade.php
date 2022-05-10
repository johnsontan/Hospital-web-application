@extends('layouts.app')

@section('content')
    <h1 class="text-center m-5 align-items-center">Book common services appointment</h1>
    <div class="container justify-content-center align-items-center d-flex mt-5">
    
        <form action="{{route('commonservices.store')}}" method="post" class="col-8 p-2">
            @csrf
            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="patient" class="fw-bold mt-3 mb-2">Patient</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="patient" id="patient" class="form-select">
                        <option value=""></option>
                        @foreach ($allPatients as $ap)
                            <option value="{{$ap->id}}">{{$ap->user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="services" class="fw-bold mt-2 mb-2">Services</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="services" id="services" class="form-select">
                        <option value=""></option>
                        @foreach ($allServices as $as)
                            <option value="{{$as->id}}">{{$as->treatmentTitle}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="nurse" class="fw-bold mt-2 mb-2">Nurse</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="nurse" id="nurse" class="form-select">
                        <option value=""></option>
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
            
            <div class="row d-flex justify-content-center mt-3 pb-3">
                <button class="btn btn-primary mt-3 col-6 d-flex justify-content-evenly">Book Appointment</button>
            </div>
        </form>
        
    </div>

<script>
    $("#services").change(function(){
        $.ajax({
            url: "{{ route('commonservices.getNurse') }}?treatment=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                //console.log(result.nurses);
                $('#nurse').html(result.nurses);
            }
        });
    });

    $("#nurse").change(function(){
        $.ajax({
            url: "{{ route('commonservices.getDate') }}?nurse=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                //console.log(result.dates);
                $('#date').html(result.dates);
            }
        });
    });

    $("#date").change(function(){
        $.ajax({
            url: "{{ route('commonservices.getTime') }}?date=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                //console.log(result.time);
                $('#time').html(result.time);
            }
        });
    });
</script>
@endsection