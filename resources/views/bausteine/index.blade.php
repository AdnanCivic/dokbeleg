@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:50px">
    <a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a>
    <alle-bausteine></alle-bausteine>
</div>

@endsection