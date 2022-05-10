@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Staff id</th>
            <th scope="col">Staff username</th>
            <th scope="col">Department</th>
            <th scope="col">Specialisation</th>
            <th scope="col">Manage timeslots</th>
          </tr>
        </thead>
        <tbody>
          @if($ms)
            @foreach ($ms as $staff)
              @if($staff->user->hasRole('doctor'))
                <tr>
                    <td>{{$staff->id}}</td>
                    <td>{{$staff->user->name}}</td>
                    <td>{{$staff->department->departmentName}}</td>
                    <td>{{$staff->specialisation->specialisation}}</td>
                    <td>
                        <a href="{{ route('availtimeslot.aindex', ['ms'=>$staff->id])}}" class="btn btn-primary btn-sm">manage</a>
                    </td>
                </tr>
              @endif
            @endforeach
          @else
            <tr>
            <td>No info</td>
            <td>No info</td>
            <td>No info</td>
            </tr>
          @endif
          
        </tbody>
      </table>
      <div>
          {{$ms->links()}}
      </div>
</div>

@endsection