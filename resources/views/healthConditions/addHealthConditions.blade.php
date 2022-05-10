@extends('layouts.app')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />

    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #ffffff;
            background: #2196f3;
            padding: 3px 7px;
            border-radius: 3px;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

    </style>
</head>

<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Add new Health Conditions</h1>
    </div>

    <form method="POST" action="{{ route('addHealthConditions.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="title" value="{{ old('title') }}" >
            @error('title')
            <div class="text-danger">
                {{'The title field is required.'}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="conditionDesc" class="form-label">Description</label>
            <textarea name="conditionDesc" class="form-control" id="conditionDesc" rows="3">{{ old('conditionDesc') }}</textarea>
            @error('conditionDesc')
            <div class="text-danger">
                {{'The description field is required.'}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="conditionTreatment" class="form-label">Recommended Treatment</label>
            <textarea name="conditionTreatment" class="form-control" id="conditionTreatment" rows="3">{{ old('conditionTreatment') }}</textarea>
            @error('conditionTreatment')
            <div class="text-danger">
                {{'The treatment field is required.'}}
            </div>
            @enderror
        </div>
        <!-- For tags -->
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <!--Put comma in between tags to seperate tags and to see the UI -->
            <input class="form-control" type="text" data-role="tagsinput" name="tags">
            @if ($errors->has('tags'))
            <span class="text-danger">{{ $errors->first('tags') }}</span>
            @endif
        </div>
        
            <div class="mb-3 form-check d-flex justify-content-center">
                <input type="checkbox" name="exampleCheck1" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">&nbspConfirm upload?</label>
            </div>
                @error('exampleCheck1')
                    <div class="text-danger d-flex justify-content-center">
                        Please confirm your upload.
                    </div>
                @enderror

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
           
    </form>
   
    <div class="d-flex justify-content-center mt-3">
            <a class="btn btn-outline-primary" href="/dashboard" role="button">
                Back to dashboard
            </a>
        </div>
        <!--For JQuery to work -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
</div>

@endsection
