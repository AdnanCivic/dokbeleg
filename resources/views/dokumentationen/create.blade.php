@extends('layouts.app')

@section('content')
<main class="container-fluid" style="padding-top:70px;width:80%">
    @include('include.messages')
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="registration_form" novalidate action="{{ route('dokumentations.store') }}"  method="post">
                        @csrf
                        <div id="modal-body">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>das ist der footer.</p>
                </div>
            </div>
        </div>
    </div>
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
                            <button type="submit" class="btn btn-success btn-block" data-toggle="modal" data-target="#formModal">Formulare für Auswahl laden</button>
                        </form>
                    </div> 
                </div>
                <div class="grid-item button-group">
                    <button class="btn btn-primary" id="alleEntfernenButton">Alle entfernen</button>
                    <button class="btn btn-primary" id="unmarkierButton">Markierung aufheben</button>
                    <button class="btn btn-primary" id="markierteEntfernenButton">Markierte Elemente entfernen</button><hr>
                    <button class="btn btn-primary btn-lg" id="obenButton">&uarr;</button>
                    <button class="btn btn-primary btn-lg" id="untenButton">&darr;</button>
                </div>
            </div>
        </div>
    <div>     
</main>
<script src="{{ asset('js/auswahl-bearbeiten.js') }}"></script>
<script src="{{ asset('js/auswahl-ajax.js') }}"></script>
<script src="{{ asset('js/fortschrittanzeige.js') }}"></script>
@endsection