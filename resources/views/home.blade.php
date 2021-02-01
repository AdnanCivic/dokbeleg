@extends('layouts.app')

@section('content')
<main class="container" id="app" style="padding-top:70px;">
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Komponentenverwaltung</h3></div>
        <div class="card-body">
            <div class="grid-container">
                <div class="grid-item card">
                    <div class="card-header"  style="text-align:center"><h5>Textbaustein</h5></div>
                    <div class="card-body">
                        <button-link route="{{ route('bausteine.index') }}">Textbausteine bearbeiten</button-link>
                    </div>
                </div>
                <div class="grid-item card">
                    <div class="card-header"  style="text-align:center"><h5>Dokument</h5></div>
                    <div class="card-body">
                        <button-link route="{{ route('dokumente.index') }}">Dokumente bearbeiten</button-link>
                        {{-- <button-link class="btn-success" route="{{ route('dokumentations.create') }}">Dokumentation erstellen</button-link> --}}
                    </div>
                </div>
                <div class="grid-item card">
                    <div class="card-header"  style="text-align:center"><h5>Benutzer</h5></div>
                    <div class="card-body">
                        {{-- <button-link route="{{ route('user.index') }}">Alle Benutzer anzeigen</button-link> --}}
                        {{-- <button-link class="btn-success" route="{{ route('user.create') }}">Benutzer anlegen</button-link> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
    
@endsection