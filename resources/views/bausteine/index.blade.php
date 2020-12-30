@extends('layouts.app')

@section('content')

<div class="container" id="app">
    <a class="btn btn-large btn-primary" href="{{ route('home') }}"><- Komponentenverwaltung</a>
    <div class="navbar navbar-expand-md">
        <router-link class="btn btn-light" :to="{name: 'AlleBausteine'}" exact>Index</router-link>
    </div>
    <div class="container">
        <router-view></router-view>
    </div>
    
</div>

@endsection