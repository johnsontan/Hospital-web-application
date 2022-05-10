@extends('layouts.app')

@section('content')
    <meta name="_token" content="{{csrf_token()}}" />

    <h1 class="text-center m-5 align-items-center">Book an appointment</h1>
    <div class="container justify-content-center align-items-center d-flex mt-5">
    
        <form action="{{ route('bookApp.store') }}" method="post" class="col-8 p-2">
            @csrf
            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <label for="specialisation" class="fw-bold mt-3 mb-2">Consultation</label>                
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center align-items-center d-flex">
                    <select name="specialisation_id" id="specialisation" class="form-select">
                        <option value=""></option>
                        @if($specialisation)
                            @foreach ($specialisation as $t)
                                <option value="{{ $t->id }}">{{$t->specialisation}}</option>
                            @endforeach
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
    $("#specialisation").change(function(){
        $.ajax({
            url: "{{ route('bookApp.treatment') }}?specialisation=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                console.log(result.doctors);
                $('#medicalStaff').html(result.doctors);
            }
        });
    });

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