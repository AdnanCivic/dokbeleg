@extends('layouts.app')

@section('content')

<div class="container" id="gru">
    <a class="btn btn-large btn-primary" href="{{ route('home') }}">&lArr; Komponentenverwaltung</a>
    <div class="navbar navbar-expand-md">
        <button type="button" class="btn btn-secondary" @click="$router.back()" style="margin-right:1rem">Zurück</button>
        <router-link class="btn btn-primary" :to="{name: 'AlleGruppen'}" exact>Index</router-link>
        <router-link class="btn btn-success" :to="{name: 'GruppeCreate'}" style="margin-left: 1rem">Gruppe erstellen</router-link>
    </div>
    <div class="container">
        <router-view></router-view>
    </div>  
</div>

@endsection