@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Promotional message detail</h1>
    </div>

    @if($promomsg)
        <label for="Title" class="form-label">Title</label>
        <input type="text" id="title" name="title" value="{{ $promomsg->title }}" class="form-control" disabled >

        <label for="promoDesc" class="form-label mt-3">Description</label>
        <input type="text" id="promoDesc" name="promoDesc" value="{{ $promomsg->promoDesc }}" class="form-control" disabled >

        <label for="countRecipients" class="form-label mt-3">Total recipients </label>
        <input type="text" id="countRecipients" name="countRecipients" value="{{ $promomsg->showRecipients->count() }}" class="form-control" disabled >

        @if($allUsersEmail)
            <label for="allUsersEmail" class="form-label mt-3">Sent to</label>
            <input type="text" id="allUsersEmail" name="allUsersEmail" value="{{ $allUsersEmail }}" class="form-control" disabled >
        @endif
    @else
        <p>No info</p>
    @endif
    <div class="mt-5">
        <a href="{{ route('promomenu.index') }}" class="btn btn-primary col-12">Back</a>
    </div>
</div>
@endsection
