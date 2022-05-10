@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="container">
                    <div class="panel-heading">
                        <h1 class="text-primary m-5">
                            Contact Us
                        </h1>    

                        <p class="m-3 px-3"> 
                                Have any issues or queries? You can contact us via the following channels:
                        </p>
                    </div>

                    <div class="pt-3 pb-3 px-4">
                        <h3 class="text-primary p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"></path>
                        </svg>
                            &nbsp Address
                        </h3>

                        <p class="px-5">
                            Blk 123 Anywhere Street, Singapore 987123
                        </p>
                    </div>

                    <div class="pt-2 pb-3 px-4">
                        <h3 class="text-primary p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-inbound-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0z"/>
                        </svg>
                            &nbsp Telephone Number
                        </h3>

                        <p class="px-5">
                            +65-1234-5678-90
                        </p>
                    </div>
                    
                    <div class="pt-2 pb-3 px-4">
                        <h3 class="text-primary p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="DodgerBlue" class="bi bi-telephone-inbound-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0z"/>
                        </svg>
                            &nbsp Email Address
                        </h3>

                        <p class="px-5">
                            hello@hospsech.com
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
                <div class="overflow-auto mt-4">
                
                    <img src="https://i.ibb.co/34G45RN/maplocation.png" alt="maplocation">
                
                </div>
        </div>
     </div>       
    
</div>
@endsection 