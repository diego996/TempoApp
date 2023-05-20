@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifica raccolta') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form  action="{{ route('raccolta.update', $raccolta->id ) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row m-3">
                                <label for="quantita" class="col-md-4 col-form-label text-md-right">{{ __('Quantità') }}</label>

                                <div class="col-md-6">
                                    <input id="quantita" type="number" class="form-control @error('quantita') is-invalid @enderror" name="quantita" value="{{ old('quantita', $raccolta->quantita) }}" required autocomplete="quantita" autofocus>

                                    @error('quantita')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row m-3">
                                <label for="data_raccolta" class="col-md-4 col-form-label text-md-right">{{ __('Data di raccolta') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="coltura_id" id="coltura_id">
                                        @foreach($colture as $coltura)
                                            <option value="{{ $coltura->id }}" {{ $raccolta->coltura->nome  == $coltura->id ? 'selected' : '' }}>{{ $coltura->nome }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row m-3">
                                <label for="data_raccolta" class="col-md-4 col-form-label text-md-right">{{ __('Data di raccolta') }}</label>

                                <div class="col-md-6">
                                    <input id="data_raccolta" type="date" class="form-control @error('data_raccolta') is-invalid @enderror" name="data" value="{{ old('data_raccolta', $raccolta->data_raccolta) }}" required autocomplete="data_raccolta" autofocus>

                                    @error('data_raccolta')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row m-3">
                                <label for="commento" class="col-md-4 col-form-label text-md-right">{{ __('Commento') }}</label>

                                <div class="col-md-6">
                                    <textarea id="commento" class="form-control @error('commento') is-invalid @enderror" name="commento" autocomplete="commento" autofocus>{{ old('commento', $raccolta->commento) }}</textarea>

                                    @error('commento')
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
                                    <a href="{{ route('raccolta.index') }}" class="btn btn-secondary">Indietro</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
