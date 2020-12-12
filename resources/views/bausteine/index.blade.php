@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:70px;">
    <a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a>
    <alle-bausteine></alle-bausteine>
</div>
{{-- <script src="/js/delete-confirm.js"></script> --}}

@endsection