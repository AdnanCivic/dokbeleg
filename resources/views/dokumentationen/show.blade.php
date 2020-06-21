@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header">
            <h3 style="text-align: center">Übersicht</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>Mandant</th><th>Bausteine</th><th>Erstellungsdatum</th><th>Updatedatum</th></tr>
                <tr><td>{{ $dbdokumentation->name }}</td><td>{{ $dbdokumentation->user->name }}</td><td>{{ count($dbdokumentation->bausteins) }}</td>
                <td>{{ date_format($dbdokumentation->created_at, 'd.m.Y') }}</td><td>{{ date_format($dbdokumentation->updated_at, 'd.m.Y') }}</td></tr>
            </table>
        </div>
    <div>     
</main>
@endsection