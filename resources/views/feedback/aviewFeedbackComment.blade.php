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
        <h1 class="text-center">View Feedback comments</h1>
    </div>
    <form>
        <div class="mb-3">
            <label for="hCondTitle" class="form-label">Comments</label>
            <input type="hCondTitle" class="form-control" id="hCondTitle" aria-describedby="hCondTitle" value="{{$feedback->comment}}" readonly>
        </div>
        
    </form>
    <div class="mb-3">
        <a href="{{ route('feedback.aview') }}" class="btn btn-outline-primary btn-sm align-end" type="button">Back</a>
    </div>
    
</div>
@endsection