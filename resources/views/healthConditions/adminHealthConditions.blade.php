@extends('layouts.app')

@section('content')
<!-- Head tag required for the jquery implementation-->
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script>
        $(document).ready(function() 
            {
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
        <h1 class="text-center">List of Health Conditions</h1>
    </div>

    <div class="row">
        <div class="col-sm-12 align-items-sm-center">
            <form name="adminSearchConditionForm" action="/searchedHealthConditions" method="POST">
                <div class="form-group form-floating mb-3 mt-3">
                    @csrf  
                    <input type="text" class="form-control" id="searchVariable" placeholder="Search for Health Condition Title" name="searchVariable">
                    <label for="searchVariable" class="text-secondary">Search for Health Condition Title</label>
                </div>
        </div>

        <div class="col-sm-12 align-items-sm-center">      
            <!-- Show all the tags the user is able to select -->
            <div class="form-group mb-3 mt-3">
                <select class="form-control tags-selector"  name="tags[]"  multiple="multiple" >
                    @if(isset($tags))
                        @foreach ($tags as $tag)
                            <option value="{{$tag->name}}">{{$tag->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
       
                <!--List 1 error message if a field is not filled  -->
                @if($errors->any())
                <li class="text-danger p-1">At least one field must be filled</li>
                @endif 
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-1 pt-4">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
                </form>
    

    <div class="table-responsive">
        <table class="table table-striped table-sm mb-3 mt-3">
            <thead>
                <tr>
                <th scope="col" class="col-1 align-middle">#</th>
                <th scope="col" class="col-2">Title</th>
                <th scope="col" class="col-5">Description</th>
                <th scope="col" class="col-3">Tags</th>
                <th scope="col" class="col-2"></th>
                </tr>
            </thead>
            <tbody>
                <!-- display default -->
                @if (!isset($errorMsg) && !isset($searchResults))
                
                @foreach($condition as $cc) 
                    <tr>
                        <th scope="row" class="align-middle">{{$cc->id}}</th>
                        <td class="align-middle">{{$cc->title}}</td>
                        <td class="align-middle">{{$cc->conditionDesc}}</td>
                        <!-- Display of tags -->
                        <td class= "align-middle" >
                            @foreach($cc->tags as $tag)
                                <span class="badge bg-info text-white m-1"> 
                                    {{$tag->name}}
                                </span>
                            @endforeach
                         </td>

                        <td class="align-middle">
                            <form method="POST" action="{{ route('deleteCondition', ['condition'=>$cc->id])}}" onSubmit="return confirm('Are you sure you wish to delete?');">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('HealthConditions.edit', ['condition' => $cc->id ])}}" class="btn btn-outline-primary btn-sm align-end m-1" type="button">Edit</a>
                                <input type="submit" class="btn btn-sm btn-outline-danger m-1" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
                {{$condition->appends(Request::except('page'))->links() }}
                
                @else
                    <!-- display search results -->
                    @if (isset($searchResults) && !isset($errorMsg))

                    @foreach($searchResults as $searchResult)  
                    <tr>
                        <th scope="row" class="align-middle">{{$searchResult->id}}</th>
                        <td class="align-middle">{{$searchResult->title}}</td>
                        <td class="align-middle">{{$searchResult->conditionDesc}}</td>
                        <!-- Display of tags -->
                        <td class= "align-middle" >
                            @foreach($searchResult->tags as $tag)
                                <span class="badge bg-info text-white m-1"> 
                                    {{$tag->name}}
                                </span>
                            @endforeach
                         </td>
                        
                        <td class="align-middle d-flex justify-content-end">
                            <form method="POST" action="{{ route('deleteCondition', ['condition'=>$searchResult->id])}}" onSubmit="return confirm('Are you sure you wish to delete?');">
                                @csrf
                                @method('DELETE')
                                <a href="/searchHealthConditions/{{$searchResult->id}}/edit" class="btn btn-outline-primary btn-sm align-end m-1" type="button">Edit</a>
                                <input type="submit" class="btn btn-sm btn-outline-danger m-1" value="Delete">
                            </form>
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
            <a class="btn btn-primary btn-sm" href="{{ route('rolebased') }}" role="button">
                Back to Dashboard
            </a>
        </div>
    </div>
    
   
</div>

@endsection
