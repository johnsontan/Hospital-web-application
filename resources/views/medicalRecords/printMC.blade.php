<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hospsech') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />

 
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- php set session -->

</head>   

<body onload="window.print()">
    @if (isset($medicalCert) && isset($patientName))
    <div class="container border border-primary mt-5 mb-5">
        <div class="row">
            <div class="text-start text-secondary fs-5 mt-3">
                MC S/N:  <?php echo sprintf('%05d',$medicalCert->id );?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 mt-5 d-flex justify-content-center">
                <img src="https://i.ibb.co/7SnC8FT/hospsech.png" alt="hospsech" class="w-25">
            </div>
        </div>
         
        <div class="row">
            <div class="text-center fs-1 mt-3">
                Medical Certificate 
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 mt-5 d-flex justify-content-center">
                This document is to certify that {{$patientName->name}} is certified to be unfit for duty for the following days:
            </div>
        </div>

        <div class="row">
            <div class="fs-3 col-sm-12 mt-5 d-flex justify-content-center">
                Start Date - End Date           
            </div>
        </div>

        <div class="row">
            <div class="fs-3 col-sm-12 mt-3 d-flex justify-content-center">
                {{$medicalCert->startDate}}
                - 
                @php
                    echo date('Y-m-d', strtotime($medicalCert->startDate. ' + '. $medicalCert->durationInDays . ' days'));
                @endphp
                
               
            </div>
        </div>
        
        <div class="row d-flex justify-content-end">
            <div class="fs-4 col-sm-4 mt-5 mb-5">
                Signed Digitally by {{$medicalCert->name}}      
            </div>
        </div>
        @else
        Medical certificate not created yet
        @endif

      

        <!--    
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
        
    </div> -->
</body>