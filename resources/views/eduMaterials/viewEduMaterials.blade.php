@extends('layouts.app')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script>
        $(document).ready(function() {
    $('.tags-selector').select2({ placeholder: "Select your tags"});
});
    </script>
</head>

<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">View Educational Materials</h1>
    </div>
    <form>
        <div class="mb-3">
            <label for="hCondTitle" class="form-label">Title</label>
            <input type="hCondTitle" class="form-control" id="hCondTitle" aria-describedby="hCondTitle" value="{{$eduMaterial->title}}" readonly>
        </div>
        <div class="mb-3">
            <label for="hCondDesc" class="form-label">Description</label>
            <textarea class="form-control" id="hCondDesc" rows="3" readonly>{{$eduMaterial->eduDesc}}</textarea>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <!--Can redesign this part -->
             <!-- Display of tags -->
                @foreach($eduMaterial->tags as $tag)
                <!--Inner css can remove and put somewhere else -->
                <span name= "tags" class="badge bg-info text-white m-1">{{$tag->name}}</span> 
                @endforeach 
        </div>
        
    </form>
    <div class="mb-3">
        <a href="{{ route('eduMaterial.search') }}" class="btn btn-outline-primary btn-sm align-end" type="button">Back</a>
    </div>
    
</div>
@endsection