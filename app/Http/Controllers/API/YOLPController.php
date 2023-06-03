<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

// YOLP(Yahoo! Open Local Platform) APIを利用し、地図・地域情報を提供するコントローラー
class YOLPController extends Controller
{
    // 座標から市区町村を取得する。
    public function getAreaByCoords(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $client = new Client();

        $options = [
            'query' => [
                'appid' => config('yahoo.api_key'),
                'lat' => $validated['latitude'],
                'lon' => $validated['longitude'],
                'datum' => 'tky',
                'output' => 'json',
            ],
        ];

        $response = $client->request('GET', 'https://map.yahooapis.jp/geoapi/V1/reverseGeoCoder', $options);
        $addressElements = json_decode($response->getBody(), true)['Feature'][0]['Property']['AddressElement'];
        $area = $addressElements[0]['Name'].$addressElements[1]['Name'];

        header('Content-type: application/json');
        echo json_encode(['area' => $area]);
    }

    // ワードから市区町村を取得する。
    public function getAreasByWord(Request $request)
    {
        $validated = $request->validate([
            'word' => 'nullable|string',
        ]);

        header('Content-type: application/json');
        $areas = [];

        if(empty($validated['word'])) {
            echo json_encode(['areas' => $areas]);
            return;
        }

        $client = new Client();

        $options = [
            'query' => [
                'appid' => config('yahoo.api_key'),
                'query' => $validated['word'],
                'ei' => 'UTF-8',
                'al' => 2,
                'ar' => 'eq',
                'results' => '10',
                'output' => 'json',
            ],
        ];

        $response = $client->request('GET', 'https://map.yahooapis.jp/geocode/V1/geoCoder', $options);
        $decoded = json_decode($response->getBody(), true);
        if(!array_key_exists('Feature', $decoded)) {
            echo json_encode(['areas' => $areas]);
            return;
        }

        $featureElements = $decoded['Feature'];


        foreach($featureElements as $featureElement) {
            array_push($areas, $featureElement['Name']);
        }

        echo json_encode(['areas' => $areas]);
    }
}
