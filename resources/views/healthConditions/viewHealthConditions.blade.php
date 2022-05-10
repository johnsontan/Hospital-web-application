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
        <h1 class="text-center">View Health Condition</h1>
    </div>

    <form>
    @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" type="title" class="form-control" id="title" aria-describedby="hCondTitle" value="{{ old('title') ?? $condition->title }}" readonly>
        </div>
        <div class="mb-3">
            <label for="conditionDesc" class="form-label">Description</label>
            <textarea name="conditionDesc" class="form-control" id="conditionDesc" rows="3" readonly>{{ $condition->conditionDesc }}</textarea>
        </div>
        <div class="mb-3">
            <label for="conditionTreatment" class="form-label">Recommended Treatment</label>
            <textarea name="conditionTreatment" class="form-control" id="conditionTreatment" rows="3" readonly>{{ $condition->conditionTreatment }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <!--Can redesign this part -->
             <!-- Display of tags -->
                @foreach($condition->tags as $tag)
                <!--Inner css can remove and put somewhere else -->
                <span name= "tags" class="badge bg-info text-white m-1">{{$tag->name}}</span> 
                @endforeach 
        </div>

    </form>

    <div class="mb-3">
        <a href="{{ route('searchCondition') }}" class="btn btn-outline-primary btn-sm align-end" type="button">Back</a>
    </div>
  
</div>
@endsection
