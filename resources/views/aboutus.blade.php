@extends('layouts.app')

@section('content')

<section class="text-center text-dark py-5">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container">
        <h1 class="text-center mb-3">ABOUT US<h1> 

        <p class="fs-3 text-center">
            Hospsech is an online doctor appointment application. 
            This application allows users to make medical appointments and 
            allows them to schedule and reschedule their appointments. 
        </p>

    </div>
</section>

<section class="p-5">
    <div class="container">
      <div class="row text-center g-4">
        <div class="col-md">
          <div class="card bg-primary text-light" style="height: 16.5rem;">
            <div class="card-body text-center">
              <div class="h1 mb-3">
                <i class="bi bi-laptop"></i>
              </div>
              <h3 class="card-title mb-3">OUR MISSION</h3>
              <p class="card-text">
                Provide clinics and hospitals with a customizable, 
                protected platform that provides excellent value at an affordable price.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md">
          <div class="card bg-info text-light">
            <div class="card-body text-center" style="height: 16.5rem;">
              <div class="h1 mb-3">
                <i class="bi bi-lightbulb"></i>
              </div>
              <h3 class="card-title mb-3">OUR VISION</h3>
              <p class="card-text">
                Using technology, assist healthcare businesses
                to provide excellent healthcare delivery and patient care worldwide.
              </p>
            </div>
          </div>
        </div>
        <!--values-->
        <div class="col-md">
          <div class="card bg-primary text-light" style="height: 16.5rem;">
            <div class="card-body text-center">
              <div class="h1 mb-3">
                <i class="bi bi-trophy"></i>
              </div>
              <h3 class="card-title mb-3">OUR VALUES</h3>
              <p class="card-text">
                Our core values are Compassion, Accountability, Respect, Integrity and Teamwork. 
                With these core values embedded in each of our staff, we are committed to serving the community.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection 