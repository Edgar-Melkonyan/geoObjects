<?php

namespace App\Repositories\GeoObject;

use App\Models\GeoObject;
use Illuminate\Pagination\LengthAwarePaginator;

interface GeoObjectRepository
{
    public function getAllGeoObjects(): LengthAwarePaginator;
    public function getGeoObject(int $id): GeoObject;
    public function createGeoObject(array $geoObjectData, array $geometryData): GeoObject;
    public function updateGeoObject(int $id, array $geoObjectData, array $geometryData): GeoObject;
    public function deleteGeoObject(int $id): void;
    public function getGeoObjectGeometries(int $id): GeoObject;
}