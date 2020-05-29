<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dokbeleg') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div>
            <main class="container" style="padding-top:70px; text-align:center">
                @include('include.messages')
                <div class="card">
                    <div class="card-header"><h3>Komponentenverwaltung</h3></div>
                    <div class="card-body">
                        <a class="btn btn-secondary btn-large" href="{{ route('dokumentations.index') }}" role="button">Dokumentationen bearbeiten</a>
                        <a class="btn btn-secondary btn-large" href="{{ route('bausteins.index') }}" role="button">Bausteine bearbeiten</a>
                    </div>
                <div>
            </main>
        </div>
    </div>
    
</body>
</html>
