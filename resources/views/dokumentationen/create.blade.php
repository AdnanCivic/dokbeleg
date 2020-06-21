@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header">
            <h3 style="text-align: center">Dokumentation erstellen</h3>
        </div>
        <div class="card-body">
            <div class="grid-container-createdoku">
                <div class="grid-item card">
                    <div class="card-header" style="text-align: center"><h5>Verfügbare Bausteine</h5></div>
                    <div class="card-body">
                        <table class="table">
                            <tr><th>Name</th><th>ID</th></tr>
                                @foreach($bausteine as $baustein)
                                    <tr><td>{{ $baustein->name }}</td><td>{{ $baustein->id }}</td></tr>
                                @endforeach
                        </table>
                    </div>
                </div>
                <div class="grid-item card">
                    <div class="card-header" style="text-align: center"><h5>Ausgewählte Bausteine</h5></div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    <div>     
</main>
@endsection