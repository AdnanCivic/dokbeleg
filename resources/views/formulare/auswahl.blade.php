@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-title" style="margin-top:10px; text-align:center"><h3>Bausteine auswählen</h3></div>
        <div class="card-body">
            <div class="table-responsive" style="margin-top:15px">
                <form method="POST" action="{{ route('auswahl')}}">
                    @csrf
                    <table id="textbausteine" class="table table-striped table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Übernehmen</th>
                        </tr>
                        @foreach($namenArray as $name)
                            <tr><td>{{ $name }}</td><td><input style="margin-left: 20px" name="textbausteine[]" type="checkbox" class="form-check-input" value=" {{ $name }} "></td></tr>
                        @endforeach
                    </table>
                    <input class="btn btn-primary" type="submit" value="Auswahl bestätigen und Formulare befüllen">
                </form>
            </div>
        </div>
    </div>
    {{-- <a class="btn btn-secondary btn-lg" href="{{ route('create')}}" role="button">PDF erstellen</a> --}}
@endsection