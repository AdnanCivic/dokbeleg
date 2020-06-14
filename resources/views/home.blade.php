@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Komponentenverwaltung</h3></div>
        <div class="card-body">
            <div class="grid-container">
                <div class="grid-item card">
                    <div class="card-header"  style="text-align:center"><h5>Textbaustein</h5></div>
                    <div class="card-body">
                        <div class="subitem">
                            <a class="btn btn-primary btn-large" href="{{ route('bausteins.index') }}" role="button">Alle Bausteine anzeigen</a>
                        </div>
                        <div class="subitem">
                            <a class="btn btn-success btn-large subbutton" href="{{ route('bausteins.create') }}" role="button">Baustein erstellen</a>
                        </div>
                    </div>
                </div>
                <div class="grid-item card">
                    <div class="card-header"  style="text-align:center"><h5>Dokumentation</h5></div>
                    <div class="card-body">
                        <div class="subitem">
                            <a class="btn btn-primary btn-large" href="{{ route('dokumentations.index') }}" role="button">Alle Dokumentationen anzeigen</a>
                        </div>
                        <div class="subitem">
                            <a class="btn btn-success btn-large subbutton" href="{{ route('dokumentations.create') }}" role="button">Dokumentation erstellen</a>
                        </div>
                    </div>
                </div>
                <div class="grid-item card">
                    <div class="card-header"  style="text-align:center"><h5>Benutzer</h5></div>
                    <div class="card-body">
                        <div class="subitem">  
                            <a class="btn btn-primary btn-large subbutton" href="{{ route('user.index') }}" role="button">Alle Benutzer anzeigen</a>
                        </div>
                        <div class="subitem">
                            <a class="btn btn-success btn-large subbutton" href="{{ route('user.create') }}" role="button">Benutzer anlegen</a>
                        </div>
                    </div>
                </div>
            <div>
        </div>
    <div>
</main>
    
@endsection