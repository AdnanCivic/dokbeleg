@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('bausteins.index') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header" style="text-align:center"><h3>Name: {{ $dbBaustein->name }}, ID: {{ $dbBaustein->id }}</h3></div>
        <div class="card-body">
            <form action="{{ route('bausteins.update', $dbBaustein->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="textarea" class="form-control" {{ $errors->has('name') ? 'alert-danger' : ''}} name="name" value="{{ $dbBaustein->name }}" required autofocus>
                </div>
                <input type="hidden" id="newHTML" name="newHTML">
                <textarea id="summernote">{!! $dbBaustein->html !!}</textarea>
                <button type="submit" class="btn btn-secondary">Änderungen speichern</button>
            </form>
        </div>    
    </div>    
</main>
<script src="{{ asset('/js/summernote-edit.js') }}"></script>
@endsection