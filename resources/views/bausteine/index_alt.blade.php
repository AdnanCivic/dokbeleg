@extends('layouts.app')

@section('content')

<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>ID</th><th>Nummer</th><th style="text-align: center">Aktion</th></tr>
                @foreach($alleBausteine as $baustein)
                <tr><td>{{ $baustein->name }}</td><td>{{ $baustein->id }}</td><td>{{ $baustein->nummer }}</td>
                    <td style="text-align: center">
                        <form method="POST" action="{{ route('bausteins.destroy', $baustein->id) }}" >
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary" href="{{ route('bausteins.show', $baustein->id) }}">Anzeigen</a>
                            <span class="entfernen"><input type="submit" class="btn btn-danger" value="Löschen"></span>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    <div>     
</main>
<script src="/js/delete-confirm.js"></script>
@endsection