@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Manage educational materials</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center">
                                <a href="{{ route('eduMaterial.create') }}" class="btn btn-outline-primary">Add educational material</a>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <a href="{{ route('eduMaterial.admin.search') }}" class="btn btn-outline-primary">View educational materials</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 