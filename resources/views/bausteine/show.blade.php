@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('bausteins.index') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header" style="text-align:center"><h3>Name: {{ $baustein->name }}, ID: {{ $baustein->id }},
             Marker: @if($baustein->marker == null) {{ "0"}} @else {{ $baustein->marker}} @endif</h3></div>
        <div class="card-body">
            <form action="{{ route('bausteins.update', $baustein->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col">
                        <label for="name">Name:</label>
                        <input type="textarea" class="form-control" {{ $errors->has('name') ? 'alert-danger' : ''}} name="name" value="{{ $baustein->name }}" required autofocus>
                    </div>
                    <div class="col">
                        <label for="nummer">Nummer:</label>
                        <input type="textarea" class="form-control {{ $errors->has('nummer') ? 'alert-danger' : ''}}" name="nummer" value="{{ $baustein->nummer }}" required>
                    </div>
                </div>
                <input type="hidden" id="newHTML" name="newHTML">
                <textarea id="summernote">{!! $baustein->html !!}</textarea>
                <button type="submit" class="btn btn-secondary">Änderungen speichern</button>
            </form>
        </div>    
    </div>    
</main>
<script src="{{ asset('/js/summernote-edit.js') }}"></script>
@endpush
@endsection