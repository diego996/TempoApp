@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Weather Forecast</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>Current Weather</h2>
                <p>City: {{ $forecast['name'] }}</p>
                <p>Temperature: {{ $forecast['main']['temp'] }}°C</p>
                <p>Humidity: {{ $forecast['main']['humidity'] }}%</p>
                <!-- Aggiungi altri dati delle previsioni che desideri visualizzare -->
            </div>

            <div class="col-md-6">
                <h2>Rain History</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    dd($rainHistory);
?>

                    {{--@foreach ($rainHistory['data'] as $rainData)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $rainData['date'] }}</td>--}}
                            {{--<td>{{ $rainData['amount'] }} mm</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
