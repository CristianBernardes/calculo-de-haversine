<?php

/**
 * @param $latitude1
 * @param $longitude1
 * @param $latitude2
 * @param $longitude2
 * @return float|int
 */
function distance($latitude1, $longitude1, $latitude2, $longitude2): float|int
{
    $earthRadius = 6371; // raio da terra em KM

    // Conversão de graus para radianos
    $latitudeFrom = deg2rad($latitude1);
    $longitudeFrom = deg2rad($longitude1);
    $latitudeTo = deg2rad($latitude2);
    $longitudeTo = deg2rad($longitude2);

    // Cálculo da diferença entre as longitudes e latitudes
    $latitudeDelta = $latitudeTo - $latitudeFrom;
    $longitudeDelta = $longitudeTo - $longitudeFrom;

    // Cálculo da distância usando a fórmula Haversine
    $angle = 2 * asin(
        sqrt(
            pow(
                sin($latitudeDelta / 2),
                2
            ) + cos($latitudeFrom) * cos($latitudeTo) * pow(
                sin($longitudeDelta / 2),
                2
            )
        )
    );

    // Retorna o resultado em KM
    return $angle * $earthRadius;
}

/**
 * @param $date
 * @param $modify
 * @return string
 */
function convertDate($date, $modify): string
{
    $dateTime = \Carbon\Carbon::createFromFormat('Y-m-d', $date);

    if ($modify === '-1') {

        $dateTime->startOfDay();
    } else {

        $dateTime->endOfDay();
    }

    return $dateTime->format('Y-m-d H:i:s');
}

/**
 * @param $str
 * @return string
 */
function stripAccents($str)
{
    return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

/**
 * @param $date
 * @param $format
 * @return string
 */
function formatDateAndTime($date, $format = 'd/m/Y')
{
    return \Carbon\Carbon::parse($date)->format($format);
}

function datetimeFormat($attribute, $value, $formats)
{
    foreach ($formats as $format) {
        $parsed = date_parse_from_format($format, $value);
        if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
            return true;
        }
    }
    return false;
}
