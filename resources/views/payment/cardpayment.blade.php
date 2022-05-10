@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-6 mx-auto mt-5">
          <div class="payment">
             <div class="payment_header">
                <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
             </div>
             <div class="pcontent">
                <h1>Payment Success !</h1>
                <p>Thank you and stay healthy</p>
                <a href="{{ route('rolebased')}}" class="btn btn-primary">Go to Home</a>
             </div>
             
          </div>
       </div>
    </div>
 </div>
@endsection