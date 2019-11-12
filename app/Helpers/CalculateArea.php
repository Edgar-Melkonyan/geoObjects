<?php

namespace App\Helpers;

class CalculateArea
{
    /**
     * Defining RADIUS
     *
     * @const RADIUS
     */
    const RADIUS = 6371;

    /**
     * Compute Area to KM2
     *
     * @param  array $path
     *
     * @return float
     */
    public static function computeAreaKm2(array $path): float
    {
        return abs(self::computeSignedArea($path,self::RADIUS));
    }


    /**
     * Returns the signed area of a closed path on a sphere of given radius
     * The computed area uses the same units as the radius squared
     *
     * @param  array $path
     * @param int $radius
     *
     * @return float
     */
    private static function computeSignedArea(array $path, int $radius): float
    {
        $size = count($path);
        if ($size < 3) { return 0; }
        $total = 0;
        $prev = $path[$size-1];
        $prevTanLat = tan((M_PI / 2 - deg2rad($prev['latitude'])) / 2);
        $prevLng = deg2rad($prev['longitude']);
        // For each edge, accumulate the signed area of the polar triangle
        foreach ($path as $point) {
            $tanLat = tan((M_PI / 2 - deg2rad($point['latitude'])) / 2);
            $lng = deg2rad($point['longitude']);
            $total += self::polarTriangleArea($tanLat, $lng, $prevTanLat, $prevLng);
            $prevTanLat = $tanLat;
            $prevLng = $lng;
        }
        return $total * ($radius * $radius);
    }

    /**
     * Returns the signed area of a triangle which has North Pole as a vertex
     *
     * @param int $tan1
     * @param int $lng1
     * @param int $tan2
     * @param int $lng2
     *
     * @return float
     */
    /*
     *
     */
    private static function polarTriangleArea($tan1, $lng1, $tan2, $lng2) : float
    {
        $deltaLng = $lng1 - $lng2;
        $t = $tan1 * $tan2;
        return (2 * atan2($t * sin($deltaLng), 1 + $t * cos($deltaLng)));
    }


}
