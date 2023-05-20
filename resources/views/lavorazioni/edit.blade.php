@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ __('Edit Lavorazione') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('lavorazioni.update', $lavorazione->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row m-2">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $lavorazione->nome }}" required autocomplete="nome" autofocus>

                                    @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row m-2">
                                <label for="coltura_id" class="col-md-4 col-form-label ">Coltura selezionata</label>
                                <div class="col-md-6">
                                <select class="form-control" name="coltura_id" id="coltura_id">
                                    @foreach($colture as $coltura)
                                        <option value="{{ $coltura->id }}" {{ $lavorazione->coltura_id == $coltura->id ? 'selected' : '' }}>{{ $coltura->nome }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row m-2">
                                <label for="tipo_lavorazione" class="col-md-4 col-form-label">Tipo di lavorazione</label>
                                <div class="col-md-6">
                                <select name="tipo_lavorazione" class="form-control" required>
                                    <option value="">Seleziona il tipo di lavorazione</option>
                                    <option value="irrigazione">Irrigazione</option>
                                    <option value="semina">Semina</option>
                                    <option value="manutenzione">Manutenzione</option>
                                    <option value="raccolta">Raccolta</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row m-2">
                                <label for="descrizione" class="col-md-4 col-form-label text-md-right">{{ __('Descrizione') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descrizione" class="form-control @error('descrizione') is-invalid @enderror" name="descrizione" required autocomplete="descrizione">{{ $lavorazione->descrizione }}</textarea>

                                    @error('descrizione')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="costo" class="col-md-4 col-form-label text-md-right">{{ __('Costo') }}</label>

                                <div class="col-md-6">
                                    <input id="costo" type="number" step="0.01" class="form-control @error('costo') is-invalid @enderror" name="costo" value="{{ $lavorazione->costo }}" required autocomplete="costo">

                                    @error('costo')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Salva') }}
                                    </button>
                                    <a href="{{ route('lavorazioni.index') }}" class="btn btn-secondary">
                                        {{ __('Annulla') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
