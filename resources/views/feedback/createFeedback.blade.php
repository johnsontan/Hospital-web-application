@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h4>Feedback</h4>
        <h6><span class="fw-bold mb-4">Patient: </span>{{ $app->patient->user->name ? $app->patient->user->name : 'No Info'}} <span class="fw-bold">Treatment: </span> {{ $app->treatment->treatmentTitle ? $app->treatment->treatmentTitle : 'No Info' }}</h6>
    </div>
    <div class="row">
        <form action="{{route('feedback.store')}}" method="post">
            @csrf
            <!-- Comment -->
            <div class="row mb-3 mt-4">
                <label for="comment" class="col-12 text-center">{{ __('Feedback') }}</label>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <textarea name="comment" id="comment" class="form-control" cols="45" rows="15" @error('comment')
                        is-invalid @enderror" name="comment" value="{{ old('comment') }}" required></textarea>

                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                </div>
            </div>

            <!-- Rating -->
            <div class="row mb-5 mt-3">
                <h5 class="text-center">Rate our treatment service</h5>
                <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> 
                </div>            
            </div>

            <!-- hidden -->
            <input type="text" value="{{$app->id}}" name="appID" id="appID" hidden readonly>
            <div class="buttons px-4 mt-1"> <button class="btn btn-primary btn-block">Submit</button> </div>
        </form>
    </div>
</div>
@endsection