@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">     </div>
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">
                        <h3>Modifica coltura</h3>
                    </div>
                    <div class="card-body text-center">
                        <form action="{{ route('colture.update', $coltura->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control w-50 m-auto" id="nome" name="nome" value="{{ $coltura->nome }}" required>
                            </div>
                            <div class="form-group">
                                <label for="descrizione">Descrizione</label>
                                <textarea class="form-control w-50 m-auto" id="descrizione" name="descrizione" rows="3" required>{{ $coltura->descrizione }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="costo">Costo</label>
                                <input type="number" step="0.1" class="form-control w-50 m-auto" id="costo" name="costo" value="{{ $coltura->costo }}" required>
                            </div>
                            <div class="form-group">
                                <label for="costo">Prezzo vendita al kg</label>
                                <input type="number" step="0.1" class="form-control w-50 m-auto" id="prezzo_vendita" name="prezzo_vendita" value="{{ $coltura->prezzo_vendita }}" required>
                            </div>
                            <hr>
                            <h4>Lavorazioni</h4>
                            <div class="form-group">
                                <select multiple class="form-control w-50 m-auto" id="lavorazioni" name="lavorazioni[]">
                                    @foreach ($lavorazioni as $lavorazione)
                                        <option value="{{ $lavorazione->id }}" >{{ $lavorazione->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Salva</button>
                            <a href="{{ route('colture.index') }}" class="btn btn-secondary">Indietro</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">     </div>
        </div>
    </div>
@endsection
