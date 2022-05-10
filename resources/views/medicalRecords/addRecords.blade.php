@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row mb-5">
            <h1 class="text-center align-items-center">What record would you like to add?</h1>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="row d-flex justify-content-evenly">
                    <div class="col-sm-3 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('addMedCert') }}" type="button">
                            Add Medical Certificate
                        </a>
                    </div>

                    <div class="col-sm-3 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('medicalRecords.displayPrescription') }}" type="button">
                            Add Prescription
                        </a>
                    </div>

                    <div class="col-sm-3 mb-3">
                        <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('addTestResults') }}" type="button">
                            Add Test Results
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection