@extends('layouts.app')

@section('content')

<div class="container" id="app">
    <a class="btn btn-large btn-primary" href="{{ route('home') }}">&lArr; Komponentenverwaltung</a>
    <div class="navbar navbar-expand-md">
        <router-link class="btn btn-secondary" :to="{name: 'AlleBausteine'}" exact>Index</router-link>
        <router-link class="btn btn-success":to="{name: 'BausteinCreate'}" style="margin-left: 10px">Baustein erstellen</router-link>
    </div>
    <div class="container">
        <router-view></router-view>
    </div>
    
</div>

@endsection