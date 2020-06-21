@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Dokumentationen</h3></div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>User-Name</th><th>ID</th><th style="text-align: center">Aktion</th></tr>
                @foreach($alleDokumentationen as $dokumentation)
                <tr><td>{{ $dokumentation->name }}</td><td>{{ $dokumentation->user->name }}</td><td>{{ $dokumentation->id }}</td>
                    <td style="text-align: center">
                        <form method="POST" action="{{ route('dokumentations.destroy', $dokumentation->id) }}" >
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary" href="{{ route('dokumentations.show', $dokumentation->id) }}">Anzeigen</a>
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