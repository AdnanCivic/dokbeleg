@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header" style="text-align:center"><h3>Baustein erstellen</h3></div>
        <div class="card-body">
            <form action="{{ route('bausteins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="textarea" class="form-control" {{ $errors->has('name') ? 'alert-danger' : ''}} name="name" value="{{ old('name') }}" required autofocus>
                </div>
                <div class="form-group">
                    <textarea class="form-control summernote" name="textbaustein" value="{{ old('textbaustein') }}"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Speichern</button>
            </form>
        </div>
    <div>     
</main>
<script src="{{ asset('/js/summernote.js') }}"></script>
@endsection