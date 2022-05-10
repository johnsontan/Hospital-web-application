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
        <h1 class="text-center">Add new Educational Materials</h1>
    </div>
    
   
    <form name="eduMaterialForm" action="{{route('eduMaterial.add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 pb-3">
            <label for="eduMatsTitle" class="form-label">Title</label>
              <!--old session data to remain even after validation failed -->
            <input type="eduMatsTitle" name = "eduMatsTitle" class="form-control" id="eduMatsTitle"  aria-describedby="eduMatsTitle" value="{{old('eduMatsTitle')}}">
            <!-- error token displays error based on the validation -->
            @error('eduMatsTitle')
            <div class="text-danger">
                {{'The title field is required.'}}
            </div>
            @enderror
            
        </div>

        <div class="mb-3 pb-3">
            <label for="eduMatsDesc" class="form-label">Description</label>
            <textarea class="form-control"  name ="eduMatsDesc" id="eduMatsDesc" rows="3">{{old('eduMatsDesc')}}</textarea>
            @error('eduMatsDesc')
            <div class="text-danger">
                {{'The description field is required.'}}
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
        
        <div class="form-check d-flex justify-content-center">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">&nbspConfirm upload?</label>
        </div> 
            @error('exampleCheck1')
            <div class="text-danger d-flex justify-content-center">
                Please confirm your upload.
            </div>
            @enderror
         

        <div class="mt-3 d-flex justify-content-center">
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
