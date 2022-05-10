@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 class="font-weight-bold text-capitalize">{{ $user->profile->name }}'s profile page</h1>
                    <table class="table">                    
                        <tbody>
                          <tr>
                            <th scope="row">Name</th>
                            <td>{{ $user->profile->name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Gender</th>
                            <td>{{ $user->profile->gender }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Phone number</th>
                            <td>{{ $user->profile->phoneNumber }}</td>
                          </tr>
                          <tr>
                            <th scope="row">DOB</th>
                            <td>{{ $user->profile->DOB }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Age</th>
                            <td>{{ $user->profile->age }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Role</th>
                            <td>Staff: {{Auth::user()->hasRole('nurse') ? 'Nurse' : 'Doctor'}}</td>
                          </tr>
                        </tbody>
                      </table>
                      <a type="button" class="btn btn-primary col-12" href="/profile/{{ $user->id }}/edit">Edit profile</a>

                      @if(auth()->user()->two_factor_confirmed)
                      <form action="/user/two-factor-authentication" class="mt-3" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger col-12">Disable 2FA</button>
                      </form>
                      <!-- 2FA enabled but not yet confirmed, we show the QRcode and ask for confirmation : -->
                      @elseif(auth()->user()->two_factor_secret)
                        <p class="mt-3 align-middle">Validate 2FA by scanning the floowing QRcode and entering the TOTP&nbsp;&nbsp;&nbsp;
                          <span class="spinner-border text-primary" role="status"></span></p>
                        
                        <div class="container">
                          <div class="row">
                            <div class="col ms-auto">                                
                              {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                            <div class="col">
                              <p class="fw-bold">Please store these recovery codes in a secure location.</p>
                              @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                                {{ trim($code) }}
                              @endforeach
                            </div>
                          </div>
                          
                        </div>                          
                        
                          <form action="{{route('two-factor.confirm')}}" class="mt-1 form-inline" method="post">
                              @csrf
                              <input name="code" class="form-text col-3" required/>
                              <br>
                              <button type="submit" class="btn btn-info col-3 mt-1">Validate 2FA</button>
                          </form>
  
                          
                          <form action="/user/two-factor-authentication" class="mt-1 form-inline" method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger col-3">Cancel 2FA</button>
                          </form>
                    
                      <!-- 2FA not enabled at all, we show an 'enable' button  : -->
                      @else
                          <form action="/user/two-factor-authentication" class="mt-3" method="post">
                              @csrf
                              <button type="submit" class="btn btn-info col-12">Activate 2FA</button>
                          </form>
                      @endif
                      <a href="{{route('rolebased.viewcp', ['user' => Auth::user()->id])}}" class="btn btn-warning col-12 mt-3">Change password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 