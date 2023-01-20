<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class OpenCageService
{
    /**
     * @param $address
     * @return array|null[]
     */
    public static function getLatLng($address): array
    {
        $apiKey = env('OPEN_CAGE_API_KEY');

        $url = 'https://api.opencagedata.com/geocode/v1/json?q=' . urlencode($address) . '&key=' . $apiKey;

        try {

            $response = Http::get($url)->json();

            return [
                'lat' => $response['results'] ? $response['results'][0]['geometry']['lat'] : null,
                'lng' => $response['results'] ? $response['results'][0]['geometry']['lng'] : null
            ];
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return [
                'lat' => null,
                'lng' => null
            ];
        }
    }
}
