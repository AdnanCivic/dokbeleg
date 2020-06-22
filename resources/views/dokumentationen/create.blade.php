@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div>
    <div class="card">
        <div class="card-header">
            <h3 style="text-align: center">Dokumentation erstellen</h3>
        </div>
        <div class="card-body">
            <div class="grid-container-createdoku">
                <div class="grid-item card" id="linkeKarte" style="margin-right:20px">
                    <div class="card-header" style="text-align: center"><h5>Verfügbare Bausteine</h5></div>
                    <div class="card-body">
                        <div class="tbody-scroll">
                            <table class="table table-hover" id="linkeTabelle">
                                <thead class="thead-dark"><tr><th>Name</th><th>ID</th></tr></thead>
                                <tbody>
                                    @foreach($bausteine as $baustein)
                                        <tr><td>{{ $baustein->name }}</td><td>{{ $baustein->id }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid-item card" id="rechteKarte" style="margin-left:20px">
                    <div class="card-header" style="text-align: center"><h5>Ausgewählte Bausteine</h5></div>
                    <div class="card-body">
                        <div class="tbody-scroll">
                            <table class="table table-hover" id="rechteTabelle">
                                <thead class="thead-dark"><tr><th>Name</th><th>ID</th><tr></thead>
                                <tbody><tr><td>ad</td></tr></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>     
</main>
<script>
    $("#linkeTabelle tbody tr").dblclick(function(){
        $(this).clone().appendTo('#rechteTabelle tbody');
    });

    $("#rechteTabelle tbody tr").on('click', function(){
        alert('ac');
        $(this).closest('tr').remove();
    });

    $(document).ready(function(){

    });
</script>
@endsection