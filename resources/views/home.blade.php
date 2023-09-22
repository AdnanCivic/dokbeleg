@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    <div class="container" id="app">
        <div class="navbar navbar-expand-md">
            <div class="btn-group" style="margin-right: 20px">
                <button type="button" class="btn btn-secondary" @click="$router.push('/')">Home</button>
                <button type="button" class="btn btn-secondary" @click="$router.back()">Zurück</button>
            </div>
            <div class="btn-group" style="margin-right: 20px; background-color:#6c757d">
                <router-link class="btn btn-primary" :to="{name: 'AlleBausteine'}" exact>Index</router-link>
                <router-link class="btn btn-success" :to="{name: 'BausteinCreate'}" style="margin-left: 10px">Baustein neu</router-link>
            </div>
            <div class="btn-group" style="margin-right: 20px; background-color:#6c757d">
                <router-link class="btn btn-primary" :to="{name: 'AlleGruppen'}" exact>Index</router-link>
                <router-link class="btn btn-success" :to="{name: 'GruppeCreate'}" style="margin-left: 10px">Gruppe neu</router-link>
            </div>
            <div class="btn-group" style="margin-right: 20px; background-color:#6c757d">
                <router-link class="btn btn-primary" :to="{name: 'AlleDokumente'}" exact>Index</router-link>
                <router-link class="btn btn-success" :to="{name: 'DokumentCreate'}" style="margin-left: 10px">Dokument neu</router-link>
            </div>
        </div>
        <div class="container">
            <router-view></router-view>
        </div> 
    </div>
</main>
    
@endsection