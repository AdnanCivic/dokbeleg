@extends('layouts.app')

@section('content')

<div class="container" id="dok">
    <a class="btn btn-large btn-primary" href="{{ route('home') }}">&lArr; Komponentenverwaltung</a>
    <div class="navbar navbar-expand-md">
        <button type="button" class="btn btn-secondary" @click="$router.back()" style="margin-right:10px">Zurück</button>
        <router-link class="btn btn-primary" :to="{name: 'AlleDokumentationen'}" exact>Index</router-link>
        <router-link class="btn btn-success" :to="{name: 'DokumentationCreate'}" style="margin-left: 10px">Dokumentation erstellen</router-link>
    </div>
    <div class="container">
        <router-view></router-view>
    </div>  
</div>

@endsection