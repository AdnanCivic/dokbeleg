@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach   
@endif

@if(session('success'))
    <div class="alert alert-success" style="margin-top: 10px">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="margin-top: 10px">
        {{ session('error') }}
    </div>
@endif
