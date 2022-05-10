@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mb-5 row justify-content-center">
            <h1 class="text-center">Referral To Other Hospitals</h1>
        </div>
            <div class="card-body">
                    <form method="POST" action="{{ route('referral.submit' )}}" enctype="multipart/form-data">
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
                            <label for="location" class="col-md-4 col-form-label text-md-right">Outgoing Hospital</label>

                            <div class="col-md-6">
                                <select name="location" id="location" class="form-select">
                                    <option value=""></option>
                                    @if($locations)
                                        @foreach ($locations as $h)
                                        <option value="{{ $h->id }}">{{$h->hospitalName}}</option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Referral Date</label>

                            <div class="col-md-6">
                                <select name="date" id="date" class="form-select">
                                    <option value=""></option>
                                    @if($date)
                                        @foreach ($date as $d)
                                        <option value="{{ $d }}">{{$d}}</option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="time" class="col-md-4 col-form-label text-md-right">Referral Time</label>

                            <div class="col-md-6">
                                <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" autofocus placeholder="13:00">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="memo" class="col-md-4 col-form-label text-md-right">Memo</label>

                            <div class="col-md-6">
                                <textarea name="memo" id="memo" rows="13" class="w-100">{{ old('memo') }}</textarea>
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
    $("#appointment").change(function(){
        $.ajax({
            url: "{{ route('referral.memo') }}?appointment=" + $(this).val(),
            method: 'GET',
            success: function(result) {
                console.log(result.memo);
                $('#memo').html(result.memo);
            }
        });
    });
</script>
@endsection
