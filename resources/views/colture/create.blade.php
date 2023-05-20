@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header">{{ __('Crea colture') }}</div>
                    <div class="card-body text-center">
                        <form class="form-horizontal" method="POST" action="{{ route('colture.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }} m-3">
                                <label for="nome" class="col-md-4 control-label">Nome coltura</label>

                                <div class="col-md-12" >
                                    <input style="margin-right: auto;margin-left: auto"  id="nome"  type="text" class="form-control w-50" name="nome" value="{{ old('nome') }}" required autofocus>

                                    @if ($errors->has('nome'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }} m-3">
                                <label for="nome" class="col-md-4 control-label">Semenza</label>
                                <div class="col-md-12" >
                                    <input style="margin-right: auto;margin-left: auto"  id="semenza"  type="text" class="form-control w-50" name="semenza" value="{{ old('semenza') }}" required autofocus>
                                    @if ($errors->has('semenza'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('semenza') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('descrizione') ? ' has-error' : '' }} m-3">
                                <label for="descrizione" class="col-md-4 control-label">Descrizione</label>

                                <div class="col-md-12 ">
                                    <textarea style="margin-right: auto;margin-left: auto"  id="descrizione" class="form-control w-50" name="descrizione" required>{{ old('descrizione') }}</textarea>

                                    @if ($errors->has('descrizione'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('descrizione') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <button style="margin-right: auto;margin-left: auto"  type="submit" class="btn btn-primary m-3">
                                        Aggiungi coltura
                                    </button>
                                    <a href="{{ route('colture.index') }}" class="btn btn-secondary">Indietro</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
