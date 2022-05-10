@extends('layouts.app')

@section('content')
<!-- Head tag required for the jquery implementation-->
<head>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
   
    <script>
        $(document).ready(function() {
    $('.tags-selector').select2({ placeholder: "Select your Treatments"});
});

    </script>
    
</head>

@if (session()->has('searchResults'))
@php
$searchResults = session()->get('searchResults');
$allTreatments = session()->get('allTreatments');
Session::forget('searchResults');
@endphp
@endif

@if (session()->has('message'))
@php
$message = session()->get('message');
$allTreatments = session()->get('allTreatments');
Session::forget('message');
@endphp
@endif

<div class="container">
    <div class="row">
        <h5>Admin: View all feedback</h5>
    </div>
    <div class="row">
        <!-- search bar -->
            <div class="col-sm-12 align-items-sm-center">
                <form name="searchFeedbackForm"  action="{{route('feedback.searchTreatment')}}" method="POST">
                 @csrf
                      <!-- Show all the tags the user is able to select -->
                <div class="col-sm-12 align-items-sm-center">  
                    <select class="form-control tags-selector" name="tags[]"  multiple="multiple">
                        @if(isset($allTreatments))
                        @foreach ($allTreatments as $treatment)
                        <option value="{{$treatment->id}}">{{$treatment->treatmentTitle}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
               
            <div class="row justify-content-center">
                <div class="col-sm-1 pt-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{'At least one treatment has to be selected'}}</li>
                    @endforeach
                </ul>
            </div>
        @endif    
        </form>
       
            </div>      
        </div>
        
    <table class="table overflow-auto">
        <thead>
            <tr>
                <th scope="col">Patient</th>
                <th scope="col">Rating</th>
                <th scope="col">Treatment</th>
            </tr>
        </thead>
      
        <tbody>
            <!-- display default -->
            @if(!isset($message) && !isset($searchResults))
                @foreach ($allFeedback as $fb)
                    <tr>
                        <td>{{$fb->patient->user->name}}</td>
                        <td>{{$fb->rating}}</td>
                        <td>{{$fb->appointment->treatment->treatmentTitle}}</td>
                        <td><a href="aview-feedback/{{$fb->id}}" class="btn btn-outline-primary btn-sm align-end" type="button">View Comments</a></td>
                    </tr>
                @endforeach
                
            @else
            <!-- display search results -->
                @if (isset($searchResults) && !isset($message))
                @foreach ($searchResults as $searchResult)
                <tr>
                    <td>{{$searchResult->name}}</td>
                        <td>{{$searchResult->comment}}</td>
                        <td>{{$searchResult->treatmentTitle}}</td>
                        <td><a href="aview-feedback/{{$searchResult->id}}" class="btn btn-outline-primary btn-sm align-end" type="button">View Comments</a></td>
                </tr>
                @endforeach
                    
                
                <a class="btn btn-primary btn-md" href="{{ route('feedback.showChart') }}" role="button">Show Chart</a>
              
                
            @else
                <!--Display no results found message -->
                <tr class="align-middle">
                    <div class="alert alert-warning d-flex align-items-center mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            {{$message}}
                        </div>
                    </div>
                </tr>
                @endif
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <a class="btn btn-primary btn-md" href="{{ route('rolebased') }}" role="button">
            Back to Dashboard
        </a>
    </div>
    
</div>
@endsection
