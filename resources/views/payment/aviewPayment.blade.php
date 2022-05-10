@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h4>Admin: Cash approval dashboard</h4>
    </div>
    <div class="row">
        <table class="table overflow-auto">
        <thead>
            <tr>
            <th scope="col">Patient name</th>
            <th scope="col">Treatment</th>
            <th scope="col">Grand total</th>
            <th scope="col">More options</th>
            </tr>
        </thead>
        <tbody>
            @if($allPaymentRec->isNotEmpty())
                @foreach ($allPaymentRec as $rec)
                    <tr>
                        <td>{{$rec->patient->user->name}}</td>
                        <td>{{$rec->appointment->treatment->treatmentTitle}}</td>
                        <td>{{$rec->grandTotal}}</td>
                        <td>
                            <form action="{{route('apayment.approve', ['paymentRec' => $rec->id])}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                
            @else
                <tr>
                    <td>No info</td>
                    <td>No info</td>
                    <td>No info</td>
                    <td>No info</td>
                </tr>   
            @endif        
        </tbody>
        </table>
    </div>
</div>
@endsection