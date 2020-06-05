@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
            @foreach($alleBausteine as $baustein)
                <tr><td>{{ $baustein->name }}  </td><td><button class="btn btn-primary">Anzeigen</button></td></tr>
            @endforeach
            </table>
        </div>
    <div>
</main>
    
@endsection