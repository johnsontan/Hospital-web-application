@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Doctor Information</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm mb-3 mt-3">
            <thead>
                <tr>
                <th scope="col" class="col-3">Doctor Name</th>
                <th scope="col" class="col-2">Doctor Specialty</th>
                <th scope="col" class="col-2">Doctor Department</th>
                <th scope="col" class="col-2">Doctor Phone Number</th>
                </tr>
            </thead>
            <tbody>
              <!-- Displayed searched results -->
              @if (!isset($message) && isset($searchResults))    
                @foreach($searchResults as $searchResult) 
                    <tr>
                    <td scope="row" class="align-middle">{{$searchResult->name}}</td>
                    <td class="align-middle">{{$searchResult->specialisation}}</td>
                    <td class="align-middle">{{$searchResult->departmentName}}</td>   
                    <td class="align-middle">{{$searchResult->phoneNumber}}</td>   
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
              @endif
            </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <a class="btn btn-primary btn-lg" href="{{ route('patient.displayDocInfoSearch') }}" role="button">
                    Back to search
                </a>

            </div>
            
           
    </div>
    
</div>
@endsection