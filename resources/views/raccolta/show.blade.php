@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Raccolta') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('Coltura') }}</th>
                                <td>{{ $raccolta->coltura->nome }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Quantità') }}</th>
                                <td>{{ $raccolta->quantita }} g</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Data di raccolta') }}</th>
                                <td>{{ $raccolta->data_raccolta }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Commento') }}</th>
                                <td>{{ $raccolta->commento }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('raccolta.index') }}" class="btn btn-primary">{{ __('Torna alla lista delle raccolte') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
