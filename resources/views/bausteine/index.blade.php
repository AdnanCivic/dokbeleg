@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>ID</th><th style="text-align: center">Aktion</th></tr>
                @foreach($alleBausteine as $baustein)
                <tr><td>{{ $baustein->name }}</td><td>{{ $baustein->id }}</td><td  style="text-align: center"><a href="{{ route('bausteins.show', $baustein->id) }}"><button class="btn btn-primary btn-sm">Anzeigen</button></a>
                <form href="{{ route('bausteins.destroy', $baustein->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Löschen</button>
                </form></td></tr>
                @endforeach
            </table>
        </div>
    <div>     
</main>
@endsection