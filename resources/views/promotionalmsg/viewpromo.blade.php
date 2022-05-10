@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="panel-heading">Promotional message</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="d-flex flex-row-reverse">
                <div class="p-2">
                    <a href="{{ route('promomenu.create') }}" class="btn btn-primary">Compose</a>
                </div>
            </div>
            <div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date/Time</th>
                        <th scope="col">More options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($promomsg)
                            @foreach ($promomsg as $promo)
                                <tr>
                                    <td>{{$promo->title}}</td>
                                    <td>{{ Str::limit($promo->promoDesc, 10, $end='....') }}</td>
                                    <td>{{$promo->created_at}}</td>
                                    <td>
                                        <a href="{{ route('promomenu.detail', ['promomsg' => $promo->id]) }}" class="btn btn-sm btn-primary">View more</a>
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

    </div>
</div>
@endsection 