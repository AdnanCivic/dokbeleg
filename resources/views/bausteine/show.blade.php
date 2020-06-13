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
                <textarea id="summernote">{!! $dbBaustein->html !!}</textarea>
                {{-- <button type="button" id="testbutton">save</button> --}}
                <button type="submit" class="btn btn-secondary">Änderungen speichern</button>
            </form>
        </div>    
    </div>    
</main>
<script>
    $(document).ready(function() {
        $("#summernote").summernote({
            height: 350
        });
        
    });
</script>
@endsection