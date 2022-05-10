@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Your Dashboard</h1>
                </div>

                <div class="panel-body mb-5">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello {{ $user->profile->name }}, what would you like to do today?
                </div>
            </div>
        </div>
    </div>
</div>
                
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="row d-flex justify-content-evenly">
                <div class="col-sm-3 mb-3">
                    <div class="accordion mb-3" id="apptAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Manage Appointments
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#apptAccordion">
                                <div class="accordion-body">
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('abookApp.index') }}" type="button">
                                        Book New Appointment
                                    </a>
                                    
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('adminApp.view') }}" type="button">
                                        View All Appointments
                                    </a>

                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('availtimeslot.viewall')}}" type="button">
                                        Manage Timeslots
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                
                <div class="col-sm-3 mb-3">
                    <div class="accordion mb-3" id="adminItemsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Other Admin Items
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#adminItemsAccordion">
                                <div class="accordion-body">
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('apayment.index') }}" type="button">
                                        Validate Payment
                                    </a>
                                        
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('feedback.aview' )}}" type="button">
                                        View Feedback
                                    </a>

                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('adminStaffAcc.index') }}" type="button">
                                        Create Staff Account
                                    </a>

                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('viewAccounts.view') }}" type="button">
                                        View Accounts
                                    </a>

                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('promomenu.index') }}" type="button">
                                        Promotional Message
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-evenly">
                <div class="col-sm-3 mb-3">
                    <div class="accordion mb-3" id="eduMatsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Manage Educational Materials
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#eduMatsAccordion">
                                <div class="accordion-body">
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('eduMaterial.search') }}" type="button">
                                        View Educational Materials
                                    </a>
                                    
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('eduMaterial.displayCreatePage') }}" type="button">
                                        Upload Educational Information
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                
                <div class="col-sm-3 mb-3">
                    <div class="accordion mb-3" id="healthCondAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Manage Health Conditions
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#healthCondAccordion">
                                <div class="accordion-body">
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('searchCondition') }}" type="button">
                                        View Health Conditions
                                    </a>
                                    
                                    <a class="btn btn-primary mt-3 mb-3 d-flex justify-content-evenly" href="{{ route('addHealthConditions') }}" type="button">
                                        Upload Health Conditions
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>  

               

            </div>
        </div>
    </div>
</div>

@endsection 