<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class WeatherForecastController extends Controller
{
    public function show($city)
    {

        $country = "jp"; // Japan
        $apiKey = env('WEATHER_API');

        $params = http_build_query([
            'q' => $city . "," . $country,
            'appid' => $apiKey
        ]);

        $forecastUrl = 'api.openweathermap.org/data/2.5/forecast?' . $params;

        try {
            $client = new Client(); //GuzzleHttp\Client

            $options['timeout'] = 1000;
            $request = $client->request('GET', $forecastUrl, $options);
            $response = json_decode($request->getBody()->getContents());
        }
        catch (GuzzleException $e) {
            $response = $e->getResponse();
            $response = $response->getBody()->getContents();
            
            return response()->json([
                'message' => 'failed',
                'data' => $response
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $response
        ]);

    }
}
