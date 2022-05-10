@extends('layouts.app')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card overflow-auto">
                <div class="upper p-4">
                    <div class="mt-2">
                        <div class="d-flex justify-content-around">
                            <h3>HospSech</h3>

                            <img src="https://i.ibb.co/yq9c8dm/hospsech-small.jpg" alt="hospsech-small">
                            
                            <h4>Payment invoice</h4>
                        </div>
                    </div>
                    <div class="">
                        <div class="d-flex justify-content-end">
                            <h6>{{$app->appDate}}</h6>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="mt-2 bg-light">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($app != null)                            
                                    <tr>
                                        <td>{{$app->treatment->treatmentTitle}}</td>
                                        <td>{{$app->medicalStaff->user->name}}</td>
                                        <td>
                                            @switch($app->appTime)
                                                @case(0)
                                                    0900HR - 1000HR
                                                    @break
                                                @case(1)
                                                    1000HR - 1100HR
                                                    @break
                                                @case(2)
                                                    1100HR - 1200HR
                                                    @break
                                                @case(3)
                                                    1300HR - 1400HR
                                                    @break
                                                @case(4)
                                                    1400HR - 1500HR
                                                    @break
                                                @case(5)
                                                    1500HR - 1600HR
                                                    @break
                                                @default
                                                    No Info
                                                    @break                                                
                                            @endswitch
                                        </td>
                                        <td>S${{$app->treatment->price}}</td>
                                    </tr>  
                                @else
                                
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 bg-light">
                        @if($allPrescription != null)
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Medication</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total price</th>
                                    </tr>
                                </thead>
                                @foreach ($allPrescription as $p)
                                    <tr>
                                        <td>{{$p->medication->medicationName}}</td>
                                        <td>{{$p->quantity}}</td>
                                        <td>{{$p->medication->price}}</td>
                                        <td>{{$p->quantity * $p->medication->price}}</td>
                                    </tr>                                    
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
                <div class="lower bg-primary p-4 pt-5 text-white d-flex justify-content-between">
                    <div class="d-flex flex-column"> <span>Cost including service charges</span> <small>Grand total may vary depending to the type of treatments.</small> </div>
                    <h3>S${{$totalAmount}}</h3>                    
                </div>
                <div class="bg-primary p-4 d-flex justify-content-end">
                    @if($patient->cardHolderName != null)
                        
                        <a href="{{ route('2fa.index') }}" id="payment" class="btn btn-info mr-3">
                            <img src="https://i.ibb.co/r6YVdPB/visamaster.png" alt="visamaster">
                        </a> 
                        <input type="text" id="appid" value="{{$app->id}}" hidden>        
                        <input type="text" id="nextRcard" value="payment.card" hidden>                   

                    @else
                        <a href="{{route('patient.create')}}" class="btn btn-info mr-3">Add card</a>
                    @endif
                    <form action="{{ route('payment.cash', ['app' => $app->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-info" type="submit">Cash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#payment").mouseover(function(){
        $.ajax({
            url: "{{ route('2fa.setVar') }}?nextR=" + $("#nextRcard").val() + "&app=" + $("#appid").val(),
            method: 'GET',
            success: function(result) {                
                console.log(result.success);
            }
        });
    });
</script>
@endsection