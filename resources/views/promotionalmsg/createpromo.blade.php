@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Compose promotional message</h1>
    </div>

    <form method="POST" action="{{ route('promomenu.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="title" value="{{ old('title') }}" required>
            @error('title')
            <div class="text-danger">
                {{'The title field is required.'}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="promoDesc" class="form-label">Description</label>
            <textarea name="promoDesc" class="form-control" id="promoDesc" rows="3" value="{{ old('promoDesc') }}" required></textarea>
            @error('promoDesc')
            <div class="text-danger">
                {{'The title field is required.'}}
            </div>
            @enderror
        </div>
        
            <div class="mb-3 form-check d-flex justify-content-center">
                <input type="checkbox" name="exampleCheck1" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">&nbspConfirm send to all patient?</label>
            </div>
                @error('exampleCheck1')
                    <div class="text-danger d-flex justify-content-center">
                        Please confirm your sent request.
                    </div>
                @enderror

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
           
    </form>
   
</div>
@endsection
