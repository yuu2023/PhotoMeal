<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class HotPepperController extends Controller
{
    private const REQUEST_URL = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/';

    // 位置情報から店舗情報を取得する。
    public function getShopsByCoords(Request $request) {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $client = new Client();

        $options = [
            'query' => [
                'key' => config('hotpepper.api_key'),
                'lat' => $validated['latitude'],
                'lng' => $validated['longitude'],
                'range' => '1',
                'count' => 30,
                'format' => 'json',
            ],
        ];

        $response = $client->request('GET', self::REQUEST_URL, $options);
        $hotpetterShop = json_decode($response->getBody(), true)['results']['shop'];

        $shops = [];
        foreach($hotpetterShop as $shop) {
            array_push($shops, ['id' => $shop['id'], 'name' => $shop['name']]);
        }

        header('Content-type: application/json');
        echo json_encode(['shops' => $shops]);
    }

    // ワードから店舗情報を取得する。
    public function getShopsByWord(Request $request)
    {
        $validated = $request->validate([
            'word' => 'nullable|string',
        ]);

        header('Content-type: application/json');
        $shops = [];

        if(empty($validated['word'])) {
            echo json_encode(['shops' => $shops]);
            return;
        }

        $client = new Client();

        $options = [
            'query' => [
                'key' => config('hotpepper.api_key'),
                'name_any' => $validated['word'],
                'order' => 1,
                'count' => 30,
                'format' => 'json',
            ],
        ];

        $response = $client->request('GET', self::REQUEST_URL, $options);
        $hotpetterShop = json_decode($response->getBody(), true)['results']['shop'];

        foreach($hotpetterShop as $shop) {
            array_push($shops, ['id' => $shop['id'], 'name' => $shop['name']]);
        }

        echo json_encode(['shops' => $shops]);
    }

    public static function getShopById(string $id) : ?array
    {
        $client = new Client();

        $options = [
            'query' => [
                'key' => config('hotpepper.api_key'),
                'id' => $id,
                'count' => 1,
                'format' => 'json',
            ],
        ];

        $response = $client->request('GET', self::REQUEST_URL, $options);
        $hotpetterShop = json_decode($response->getBody(), true)['results']['shop'];

        if(!isset($hotpetterShop[0])) {
            return null;
        }

        return [
            'id' => $hotpetterShop[0]['id'],
            'name' => $hotpetterShop[0]['name'],
            'address' => $hotpetterShop[0]['address'],
            'open' => $hotpetterShop[0]['open'],
            'latitude' => $hotpetterShop[0]['lat'],
            'longitude' => $hotpetterShop[0]['lng'],
        ];
    }
}
