@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

<form method="POST" action="{{ route('irrigazioni.store') }}">
    @csrf
    <div class="form-group">
        <label for="coltura_id">Coltura</label>
        <select class="form-control" id="coltura_id" name="coltura_id">
            @foreach($colture as $coltura)
                <option value="{{ $coltura->id }}">{{ $coltura->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="data_irrigazione">Data irrigazione</label>
        <input type="text" class="form-control datepicker" id="data_irrigazione" name="data_irrigazione" required>
    </div>
    <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control" id="note" name="note"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Salva irrigazione</button>
</form>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
        </div></div>
@endsection