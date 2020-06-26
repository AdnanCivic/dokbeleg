@extends('layouts.app')

@section('content')
<main class="container-fluid" style="padding-top:70px;width:80%">
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
                        <div class="tbody-scroll">
                            <table class="table table-hover" id="linkeTabelle">
                                <thead class="thead-dark"><tr><th>Name</th><th>ID</th><th></th></tr></thead>
                                <tbody id="linkeListe">
                                    @foreach($bausteine as $baustein)
                                        <tr class="reihe"><td>{{ $baustein->name }}</td><td>{{ $baustein->id }}</td>
                                        <td><input name="bausteinid" type="checkbox" value="{{ $baustein->id}}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>     
                    </div>
                    <div class="btn-group">
                        <button id="markierbutton" class="btn btn-primary">Alle Markieren</button>
                        <button id="uncheckbutton" class="btn btn-secondary">Markierung aufheben</button>
                        <button id="transferbutton" class="btn btn-success">Markierte übernehmen</button>
                    </div>
                </div>
                <div class="grid-item card" id="rechteKarte" style="margin-left:20px">
                    <div class="card-header" style="text-align: center"><h5>Ausgewählte Bausteine</h5></div>
                    <div class="card-body">
                        <form id="selectBausteine" method="POST">
                            @csrf
                            <div class="tbody-scroll">
                                <table class="table table-hover" id="rechteTabelle">
                                    <thead class="thead-dark"><tr><th>Name</th><th>ID</th><th></th><tr></thead>
                                    <tbody id="rechteListe"></tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Formulare für Auswahl laden</button>
                        </form>
                    </div> 
                </div>
                <div class="grid-item button-group">
                    <button class="btn btn-primary" id="alleEntfernenButton">Alle entfernen</button>
                    <button class="btn btn-primary" id="unmarkierButton">Markierung aufheben</button>
                    <button class="btn btn-primary" id="markierteEntfernenButton">Markierte Elemente entfernen</button><hr>
                    <button class="btn btn-primary" id="obenButton">Nach oben verschieben</button>
                    <button class="btn btn-primary" id="untenButton">Nach unten verschieben</button>
                </div>
            </div>
        </div>
    <div>     
</main>
<script src="{{ asset('js/auswahl-bearbeiten.js') }}"></script>
<script src="{{ asset('js/auswahl-ajax.js') }}"></script>
@endsection