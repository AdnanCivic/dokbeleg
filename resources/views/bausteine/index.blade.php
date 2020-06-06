@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div class="card">
        <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
            @foreach($alleBausteine as $baustein)
            <tr><td>{{ $baustein->name }}  ID: {{ $baustein->id }}</td><td><a href="{{ route('bausteins.show', $baustein->id) }}"><button class="btn btn-primary btn-sm">Anzeigen</button></a></td></tr>
            @endforeach
            </table>
            <div id="summernote"><p>Hello Summernote!</p></div>
        </div>
    <div>     
</main>
<script>
    $(document).ready(function() {
        $("#summernote").summernote({
            height: 350,
        });
    });
</script>
@endsection