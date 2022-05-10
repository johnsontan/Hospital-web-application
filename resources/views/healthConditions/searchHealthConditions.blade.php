
@extends('layouts.app')

@section('content')
<!-- Head tag required for the jquery implementation-->
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script>
        $(document).ready(function() {
    $('.tags-selector').select2({ placeholder: "Select your tags"});
});
    </script>
</head>

@if (session()->has('searchResults'))
@php
$searchResults = session()->get('searchResults');
$tags = session()->get('tags');
Session::forget('searchResults');
@endphp
@endif

@if (session()->has('errorMsg'))
@php
$errorMsg = session()->get('errorMsg');
$tags = session()->get('tags');
Session::forget('message');
@endphp
@endif

<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Search for Health Conditions</h1>
    </div>
    
    <div class="row">
    <!-- search bar -->
        <div class="col-sm-12 align-items-sm-center">
            <form name="searchConditionForm"  action="{{route('searchCondition.result')}}" method="POST">
                <div class="form-floating mb-3 mt-3">
                    @csrf 
                    <input type="text" class="form-control" id="searchVariable" placeholder="What symptoms do you have?" name="searchVariable" value="{{old('searchVariable')}}">
                    <label for="searchVariable" class="text-secondary">Keywords...</label>
                </div>
        </div>      
        
        <!-- Show all the tags the user is able to select -->
        <div class="col-sm-12 align-items-sm-center">  
            <select class="form-control tags-selector" name="tags[]"  multiple="multiple">
                @if(isset($tags))
                @foreach ($tags as $tag)
                <option value="{{$tag->name}}">{{$tag->name}}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-1 pt-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    </div>

    <div class="table-responsive-sm">
        <table class="table table-striped table-sm mb-3 mt-3">
            <thead>
                <tr>
                <th scope="col" class="col-1 align-middle">#</th>
                <th scope="col" class="col-2">Title</th>
                <th scope="col" class="col-6">Description</th>
                <th scope="col" class="col-2">Tags</th>
                <th scope="col" class="col-3"></th>
                </tr>
            </thead>
            <tbody>
                <!-- display default -->
                @if (!isset($errorMsg) && !isset($searchResults))
                
                @foreach($condition as $cond) 
                    <tr class="h-100">
                        <th scope="row" class="align-middle h-100">{{$cond->id}}</th>
                        <td class="align-middle h-100">{{$cond->title}}</td>
                        <td class="align-middle text-break h-100">{{$cond->conditionDesc}}</td>
                        <!-- Display of tags -->
                        <td class= "align-middle h-100">
                            @foreach($cond->tags as $tag)
                                <span class="badge bg-info text-white m-1"> 
                                    {{$tag->name}}
                                </span>
                            @endforeach
                         </td>
                        <td class="align-middle">
                            <a href="/searchHealthConditions/{{$cond->id}}/view" class="btn btn-outline-primary btn-sm" type="button">See More</a>
                        </td>
                    </tr>
                @endforeach
                {{$condition->appends(Request::except('page'))->links() }}

                @else
                    <!-- display search results -->
                    @if (isset($searchResults) && !isset($errorMsg))

                    @foreach($searchResults as $searchResult) 
                    <tr class="h-100">
                        <th scope="row" class="align-middle h-100">{{$searchResult->id}}</th>
                        <td class="align-middle h-100">{{$searchResult->title}}</td>
                        <td class="align-middle h-100">{{$searchResult->conditionDesc}}</td>
                         <!-- Display of tags -->
                         <td class= "align-middle h-100" >
                            @foreach($searchResult->tags as $tag)
                                <span class="badge bg-info text-white m-1"> 
                                    {{$tag->name}}
                                </span>
                            @endforeach
                         </td>
                        <td class="align-middle">
                            <a href="/searchHealthConditions/{{$searchResult->id}}/view" class="btn btn-outline-primary btn-sm align-end" type="button">See More</a>
                        </td>
                    </tr>
                    @endforeach
                    {{$searchResults->appends(Request::except('page'))->links() }}
                    @else
                     <!--Display no results found message -->
                     <tr class="align-middle">
                        <div class="alert alert-warning d-flex align-items-center mt-2" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                No results found.
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
   
</div>
@endsection

