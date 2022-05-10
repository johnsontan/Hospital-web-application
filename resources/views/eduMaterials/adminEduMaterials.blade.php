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

@if (session()->has('message'))
@php
$message = session()->get('message');
$tags = session()->get('tags');
Session::forget('message');
@endphp
@endif

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Search for Educational Materials (Admin)</h1>
    </div>

    <div class="row">
        <div class="col-sm-12 align-items-sm-center">
            <!--Search for educational material -->
            <form name="searchEduMaterialForm" action="{{ route('eduMaterial.findSearch') }}" method="POST">
                <div class="form-group form-floating mb-3 mt-3">
                    @csrf
                    <input type="text" class="form-control" id="searchVariable" name="searchVariable" placeholder="Keywords" value="{{old('searchVariable')}}">
                    <label for="searchVariable" class="text-secondary">Keywords...</label>
                </div>

                 <!-- Show all the tags the user is able to select -->
                <div class="form-group mb-3 mt-3">
                    <select class="form-control tags-selector width-auto" name="tags[]"  multiple="multiple">
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
    
    <div class="col table-responsive">
        <table class="table table-striped table-sm mb-3 mt-3">
            <thead>
                <tr>
                <th scope="col" class="col-1 align-middle">#</th>
                <th scope="col" class="col-3">Title</th>
                <th scope="col" class="col-2">Date Published</th>
                <th scope="col" class="col-3">Tags</th>
                <th scope="col" class="col-3"></th>
                </tr>
            </thead>
           
            <tbody>
                @if (!isset($message) && !isset($searchResults))
                <!-- Display all educational materials on default -->
                @foreach($eduMaterials as $eduMaterial) 
                    <tr>
                    <th scope="row" class="align-middle">{{$eduMaterial->id}}</th>
                    <td class="align-middle">{{$eduMaterial->title}}</td>
                    <td class="align-middle">{{$eduMaterial->created_at->toDateString()}}</td>   
                    <!-- Display of tags -->
                    <td class="align-middle">
                        @foreach($eduMaterial->tags as $tag)
                        <span class="badge bg-info text-white m-1"> 
                            {{$tag->name}}
                        </span>
                        @endforeach
                    </td>
                    <td class="align-middle" >
                        <form action="{{ route('eduMaterial.destroy', ["edu" => $eduMaterial->id])}}" method="post" onSubmit="return confirm('Are you sure you wish to delete?');">
                            @csrf
                            @method('DELETE')

                            <a href="/viewEduMaterials/{{ $eduMaterial->id }}" class="btn btn-outline-primary btn-sm align-end m-1" type="button">See More</a>  
                            <a href="/editEduMaterials/{{ $eduMaterial->id }}" class="btn btn-outline-primary btn-sm align-end m-1" type="button">Edit</a>
                            <input type="submit" class="btn btn-outline-danger btn-sm align-end m-1" type="button" value="Delete">
                        </form>
                    </td>
                    </tr>
                @endforeach
                {{$eduMaterials->appends(Request::except('page'))->links() }}
                @else
                <!-- Displayed searched results -->
                    @if (!isset($message) && isset($searchResults))
                    @foreach($searchResults as $searchResult) 
                    <tr>
                    <th scope="row" class="align-middle">{{$searchResult->id}}</th>
                    <td class="align-middle">{{$searchResult->title}}</td>
                    <td class="align-middle">{{$searchResult->created_at->toDateString()}}</td>  
                     <!-- Display of tags -->
                     <td class="align-middle">
                        @foreach($searchResult->tags as $tag)
                            <span class="badge bg-info text-white m-1"> 
                                {{$tag->name}}
                            </span>
                        @endforeach
                    </td>
                    <td class="align-middle d-flex justify-content-end">
                        <form action="{{ route('eduMaterial.destroy', ["edu" => $searchResult->id])}}" method="post" onSubmit="return confirm('Are you sure you wish to delete?');">
                            @csrf
                            @method('DELETE')

                            <a href="/viewEduMaterials/{{ $searchResult->id }}" class="btn btn-outline-primary btn-sm align-end m-1" type="button">See More</a>  
                            <a href="/editEduMaterials/{{ $searchResult->id }}" class="btn btn-outline-primary btn-sm align-end m-1" type="button">Edit</a>
                            <input type="submit" class="btn btn-outline-danger btn-sm align-end m-1" type="button" value="Delete">
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
