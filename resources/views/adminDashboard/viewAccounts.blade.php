@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3"><h5>ADMIN: [{{ Auth::user()->name }}]</h5></div>
    <div class="row d-flex justify-content-evenly mt-3 pb-3">

        <a class="btn btn-primary col-4" data-bs-toggle="collapse" href="#staff" role="button" aria-expanded="false" aria-controls="upcoming">
            Staff Accounts
        </a>    
        <a class="btn btn-info col-4" data-bs-toggle="collapse" href="#patient" role="button" aria-expanded="false" aria-controls="past">
            Patient Accounts
        </a>   
        <div class="collapse mt-3" id="staff">
            <div class="card card-body overflow-auto">
                <h4>Staff Accounts</h4>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Staff ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Department</th>
                        <th scope="col">Specialisation</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($staffs->isNotEmpty())
                            @foreach ($staffs as $s)
                                <tr>
                                    <td>{{ $s->user_id }}</td>
                                    <td>{{ $s->id }}</td>
                                    <td>{{ $s->name }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>{{ $s->departmentName }}</td>
                                    <td>{{ $s->specialisation }}</td>
                                    <td>
                                        @switch ($s->status)
                                            @case(0)
                                                banned
                                                @break
                                            @case(1)
                                                active
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($s->status==1)
                                            <form action="{{ route('viewAccounts.suspend', ['user' => $s->user_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to suspend this account?');">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Suspend</button>
                                            </form>

                                        @else
                                            <form action="{{ route('viewAccounts.unsuspend', ['user' => $s->user_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to unsuspend this account?');">
                                            @csrf
                                            <button class="btn btn-info" type="submit">Unsuspend</button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>  
                            @endforeach                              
                        @else
                            <tr>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td></td>
                            </tr>  
                        @endif
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="collapse mt-3" id="patient">
            <div class="card card-body overflow-auto">
                <table class="table">
                    <h4>Patient Accounts</h4>
                    <thead>
                      <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Patient ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($patients->isNotEmpty())
                            @foreach ($patients as $p)
                                <tr>
                                    <td>{{ $p->user_id }}</td>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>
                                        @switch($p->status)
                                            @case(1)
                                                active
                                                @break
                                            @case(0)
                                                banned
                                                @break
                                            @default
                                                NIL
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($p->status==1)
                                            <form action="{{ route('viewAccounts.suspend', ['user' => $p->user_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to suspend this account?');">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Suspend</button>
                                            </form>

                                        @else
                                            <form action="{{ route('viewAccounts.unsuspend', ['user' => $p->user_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to unsuspend this account?');">
                                            @csrf
                                            <button class="btn btn-info" type="submit">Unsuspend</button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>  
                            @endforeach                              
                        @else
                            <tr>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td></td>
                            </tr>  
                        @endif                     
                    </tbody>
                  </table>
            </div>
        </div>

    </div>
    
</div>

@endsection