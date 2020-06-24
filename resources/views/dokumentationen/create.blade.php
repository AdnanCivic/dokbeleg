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
                <div class="grid-item card" id="linkeKarte" style="margin-right:20px">
                    <div class="card-header" style="text-align: center"><h5>Verfügbare Bausteine</h5></div>
                    <div class="card-body">
                    <form id="selectBausteine" method="POST">
                            @csrf
                            <div class="tbody-scroll">
                                <table class="table table-hover" id="linkeTabelle">
                                    <thead class="thead-dark"><tr><th>Name</th><th>ID</th><th></th></tr></thead>
                                    <tbody>
                                        @foreach($bausteine as $baustein)
                                            <tr class="reihe"><td>{{ $baustein->name }}</td><td>{{ $baustein->id }}</td>
                                            <td><input name="bausteinid" type="checkbox" value="{{ $baustein->id}}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><hr>
                            <button type="submit" class="btn btn-primary btn-block">Markierte übernehmen</button>
                        </form>
                    </div>
                    
                </div>
                <div class="grid-item card" id="rechteKarte" style="margin-left:20px">
                    <div class="card-header" style="text-align: center"><h5>Ausgewählte Bausteine</h5></div>
                    <div class="card-body">
                        <div class="tbody-scroll">
                            <table class="table table-hover" id="rechteTabelle">
                                <thead class="thead-dark"><tr><th>Name</th><th>ID</th><th></th><tr></thead>
                                <tbody id="rechteListe"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary">Markierte entfernen</button>
                        <button class="btn btn-success">Dokumentation erstellen</button>
                    </div>
                </div>
                
            </div>
        </div>
    <div>     
</main>
<script src="{{ asset('js/auswahl-nach-rechts-ajax.js') }}"></script>
@endsection