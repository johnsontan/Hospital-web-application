@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Search for Doctor</h1>
    </div>
    
    <div class="row">
        
    <!-- search bar -->
    <form name="searchDocInfoForm"  action="/searchedDocInfo" method="POST">
    
        <div class="col-sm-11 align-items-sm-center">
            <div class="form-floating mb-3 mt-3">
            @csrf 
                <input type="text" class="form-control" id="docName" placeholder="Doctor Name" name="docName" value="{{old('docName')}}">
                <label for="doctorName">Doctor Name</label>
                @error('docName')
                <div class="text-danger">
                        {{'At least one field has to be filled'}}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-sm-11 align-items-sm-center">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="docSpecialty" placeholder="Specialty" name="docSpecialty" value="{{old('docSpecialty')}}">
                <label for="docSpecialty">Specialty</label>
                @error('docSpecialty')
                <div class="text-danger">
                        {{'At least one field has to be filled'}}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-sm-11 align-items-sm-center">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="docDepartment" placeholder="Department" name="docDepartment" value="{{old('docDepartment')}}">
                <label for="docDepartment">Department</label>
                @error('docDepartment')
                <div class="text-danger">
                        {{'At least one field has to be filled'}}
                </div>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-center" >
            <button type="submit" class="btn btn-primary">Search for Doctor</button>
        </div>
    </form>
    </div>

   
</div>
@endsection