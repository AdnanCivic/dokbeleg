@extends('layouts.app')

@section('content')
<main class="container" style="padding-top:70px;">
    @include('include.messages')
    <div class="card">
        <div class="card-header" style="text-align:center"><h3>Name: {{ $dbBaustein->name }}, ID: {{ $dbBaustein->id }}</h3></div>
        <div class="card-body">
            <div id="summernote"></div>
        </div>
    <div>     
</main>
<script>
    $(document).ready(function() {
        $("#summernote").summernote({
            height: 350
        });
    });
    
</script>
@endsection