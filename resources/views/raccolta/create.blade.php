@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Elenco Raccolte</div>

                    <div class="card-body">
    <div class="container">
        <h2>Inserisci una nuova raccolta</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('raccolta.store') }}" method="POST">
            @csrf
            <div class="form-group text-center m-2">
                <label for="coltura">Coltura</label>
                <select class="form-control w-50 m-auto" id="coltura_id" name="coltura_id" >
                    @foreach($colture as $coltura)
                        <option value="{{ $coltura->id }}">{{ $coltura->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group text-center m-2">
                <label for="quantita">Quantità in grammi</label>
                <input type="number" min="0" step="10" class="form-control w-50 m-auto" id="quantita" name="quantita" required>
            </div>
            <div class="form-group text-center m-2">
                <label for="data">Data di raccolta</label>
                <input type="date" class="form-control  w-50 m-auto" id="data" name="data" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group text-center m-2">
                <label for="commento">Commento</label>
                <textarea class="form-control w-50 m-auto" id="commento" name="commento" rows="3"></textarea>
            </div>
            <div class="form-group text-center m-2">
            <button type="submit" class="btn btn-primary m-auto">Salva</button>
            </div>
        </form>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
