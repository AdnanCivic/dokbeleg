@extends('layouts.app')

@section('content')

<div id="app">
    <alle-bausteine></alle-bausteine>
</div>

<script src="{{ mix('js/app.js') }}"></script>
<script src="/js/delete-confirm.js"></script>
@endsection