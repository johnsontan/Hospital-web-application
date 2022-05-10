@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mb-5 row justify-content-center">
            <h1 class="text-center">Referral To Other Departments</h1>
        </div>
            <div class="card-body">
                    <form method="POST" action="{{ route('referral.dsubmit' )}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="appointment" class="col-md-4 col-form-label text-md-right">Appointment ID</label>

                            <div class="col-md-6">
                                <select name="appointment" id="appointment" class="form-select">
                                    <option value=""></option>
                                    @if($appointments)
                                        @foreach ($appointments as $a)
                                        <option value="{{ $a->id }}">{{$a->id}}</option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>

                            <div class="col-md-6">
                                <select name="department" id="department" class="form-select">
                                    <option value=""></option>
                                    @if($departments)
                                        @foreach ($departments as $d)
                                        <option value="{{ $d->id }}">{{$d->departmentName}}</option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="specialisation" class="col-md-4 col-form-label text-md-right">Specialisation</label>

                            <div class="col-md-6">
                                <select name="specialisation" id="specialisation" class="form-select">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="medicalStaff" class="col-md-4 col-form-label text-md-right">Doctor</label>

                            <div class="col-md-6">
                                <select name="medicalStaff" id="medicalStaff" class="form-select">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Referral Date</label>

                            <div class="col-md-6">
                                <select name="date" id="date" class="form-select">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="time" class="col-md-4 col-form-label text-md-right">Referral Time</label>

                            <div class="col-md-6">
                                <select name="time" id="time" class="form-select">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="memo" class="col-md-4 col-form-label text-md-right">Memo</label>

                            <div class="col-md-6">
                            <textarea name="memo" id="memo" rows="10" class="w-100">{{ old('memo') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    Submit Referral 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#department").change(function(){
        $.ajax({
            url: "{{ route('referral.sp') }}?department=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                console.log(result.sp);
                $('#specialisation').html(result.sp);
            }
        });
    });

    $("#specialisation").change(function(){
        $.ajax({
            url: "{{ route('referral.staff') }}?specialisation=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                console.log(result.doctors);
                $('#medicalStaff').html(result.doctors);
            }
        });
    });

    $("#medicalStaff").change(function(){
        $.ajax({
            url: "{{ route('referral.date') }}?ms=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                $('#date').html(result.ats);
            }
        });
    });

    $("#date").change(function(){
        let myArray = $(this).val().split("|");
        $.ajax({
            url: "{{ route('referral.time') }}?ms=" + myArray[0] + "&date=" + myArray[1] ,
            method: 'GET',
            success: function(result) {
                $('#time').html(result.blockNum);
            }
        });
    });

    $("#appointment").change(function(){
        $.ajax({
            url: "{{ route('referral.dMemo') }}?appointment=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                console.log(result.memo);
                $('#memo').html(result.memo);
            }
        });
    });
</script>
@endsection
