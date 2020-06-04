@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Komponentenverwaltung</h3></div>
        <div class="card-body">
            <a class="btn btn-secondary btn-large" href="{{ route('dokumentations.index') }}" role="button">Dokumentationen bearbeiten</a>
            <a class="btn btn-secondary btn-large" href="{{ route('bausteins.index') }}" role="button">Bausteine bearbeiten</a>
            <a class="btn btn-secondary btn-large" href="{{ route('user.index') }}" role="button">Benutzer verwalten</a>
        </div>
    <div>
</main>
    
@endsection