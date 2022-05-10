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
        <h1 class="text-center">Edit Educational Material: {{$eduMaterial->id}}</h1>
    </div>

    

    <form name="editEduMaterialForm" action="/editEduMaterials/{{$eduMaterial->id}}" method="POST">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="hCondTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="hCondTitle" aria-describedby="hCondTitle" name="hCondTitle" value="{{$eduMaterial->title}}">
            @error('hCondTitle')
            <div class="text-danger">
                {{'The title field is required.'}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hCondDesc" class="form-label">Description</label>
            <textarea class="form-control" id="hCondDesc"  name="hCondDesc" rows="3">{{$eduMaterial->eduDesc}}</textarea>
            @error('hCondDesc')
            <div class="text-danger">
                {{'The title field is required.'}}
            </div>
            @enderror
        </div>

         <!-- For tags -->
         <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <!--Put comma in between tags to seperate tags and to see the UI -->
            <input class="form-control" type="text" data-role="tagsinput" name="tags"  value = "@foreach ($eduMaterial->tags as $tag) {{$tag->name}},@endforeach">
           
            @if ($errors->has('tags'))
            <span class="text-danger">{{ $errors->first('tags') }}</span>
            @endif

        </div>

            <div class="mb-3 form-check d-flex justify-content-center">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">&nbspConfirm edit?</label>
            </div>
                @error('exampleCheck1')
                    <div class="text-danger d-flex justify-content-center">
                        Please confirm your edit.
                    </div>
                @enderror

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        <!--For JQuery to work -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    </form>
   
    <div class="mb-3">
        <a href="{{ route('eduMaterial.search') }}" class="btn btn-outline-primary btn-sm align-end" type="button">Back</a>
    </div>
</div>
@endsection
