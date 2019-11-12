<?php

namespace App\Repositories\GeoObject;

use App\Models\GeoObject;
use Illuminate\Pagination\LengthAwarePaginator;

class GeoObjectService implements GeoObjectRepository
{
    /**
     * Defining Items per page
     *
     * @const PER_PAGE
     */
    const PER_PAGE = 10;

    /**
     * @var $geoObject
     */
    protected $geoObject;

    /**
     * GeoObjectService constructor.
     *
     * @param GeoObject $geoObject
     */
    public function __construct(GeoObject $geoObject)
    {
        $this->geoObject = $geoObject;
    }

    /**
     * Get paginated geo objects.
     *
     * @return LengthAwarePaginator
     */
    public function getAllGeoObjects(): LengthAwarePaginator
    {
        return $this->geoObject->with(['type','geometry'])->paginate(self::PER_PAGE);
    }

    /**
     * Get geometries of the given geo object.
     *
     * @param int $id
     *
     * @return GeoObject
     */
    public function getGeoObjectGeometries(int $id): GeoObject
    {
        $geoObject = $this->geoObject->findOrFail($id);
        return $geoObject->load(['type','geometry' => function($query) {
            $query->withTrashed();
        }]);
    }

    /**
     * Get Geo Object by id.
     *
     * @param int $id
     *
     * @return GeoObject
     */
    public function getGeoObject(int $id): GeoObject
    {
        return $this->geoObject->with(['type','geometry'])->findOrFail($id);
    }

    /**
     * Create a new GeoObject.
     *
     * @param array $geoObjectData
     * @param array $geometryData
     *
     * @return GeoObject
     */
    public function createGeoObject(array $geoObjectData, array $geometryData): GeoObject
    {
        $geoObject = $this->geoObject->create($geoObjectData);
        $geoObject->geometry()->createMany($geometryData);
        return $geoObject->load(['type','geometry']);
    }

    /**
     * Update GeoObject by id.
     *
     * @param int $id
     * @param array $geoObjectData
     * @param array $geometryData
     *
     * @return GeoObject
     */
    public function updateGeoObject(int $id, array $geoObjectData, array $geometryData): GeoObject
    {
        $geoObject = $this->geoObject->findOrFail($id);
        $geoObject->update($geoObjectData);
        $geoObject->geometry()->delete();
        $geoObject->geometry()->createMany($geometryData);
        return $geoObject->load(['type','geometry']);
    }

    /**
     * Delete GeoObject by id.
     *
     * @param int $id
     *
     * @return void
     */
    public function deleteGeoObject(int $id): void
    {
        $this->geoObject->findOrFail($id)->delete();
    }
}