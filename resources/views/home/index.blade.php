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


?>

                    {{--@foreach ($rainHistory['data'] as $rainData)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $rainData['date'] }}</td>--}}
                            {{--<td>{{ $rainData['amount'] }} mm</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    </tbody>
                </table>
                <div id="openweathermap-widget-11"></div>
                <script src='//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'></script><script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 11,cityid: '3175491',appid: 'f0c0b0b56729998f56dcd0b9b2455cc1',units: 'metric',containerid: 'openweathermap-widget-11',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
            </div>
        </div>
    </div>
@endsection
