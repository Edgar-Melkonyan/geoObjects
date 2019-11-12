<?php

namespace App\Http\Controllers\Api;

use App\Repositories\GeoObject\GeoObjectRepository;
use App\Http\Requests\GeoObjectRequest;
use App\Helpers\CalculateArea;

class GeoObjectController extends Controller
{
    /**
     * @var $geoObjectRepository
     */
    protected $geoObjectRepository;

    /**
     * GeoObjectController constructor.
     *
     * @param GeoObjectRepository $geoObjectRepository
     */
    public function __construct(GeoObjectRepository $geoObjectRepository)
    {
        $this->geoObjectRepository = $geoObjectRepository;
    }

    /**
     * Display a listing of the geo objects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geoObjects = $this->geoObjectRepository->getAllGeoObjects();
        return response()->json(['success' => $geoObjects], self::HTTP_OK);
    }

    /**
     * Get geometries of the given geo object.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function getGeoObjectGeometries(int $id)
    {
        $geoObjectGeometries = $this->geoObjectRepository->getGeoObjectGeometries($id);
        return response()->json(['success' => $geoObjectGeometries], self::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $geoObject = $this->geoObjectRepository->getGeoObject($id);
        return response()->json(['success' =>  $geoObject ], self::HTTP_OK);
    }

    /**
     * Store a newly created geo object.
     *
     * @param GeoObjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeoObjectRequest $request)
    {
        $request['area'] = CalculateArea::computeAreaKm2($request->geometry);
        $geoObject = $this->geoObjectRepository->createGeoObject($request->only('name', 'area','description','type_id'), $request->geometry);
        return response()->json(['success' =>  $geoObject ] ,self::HTTP_CREATED );
    }

    /**
     * Update the specified geo object .
     *
     * @param  int  $id
     * @param GeoObjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id , GeoObjectRequest $request)
    {
        $request['area'] = CalculateArea::computeAreaKm2($request->geometry);
        $geoObject = $this->geoObjectRepository->updateGeoObject($id, $request->only('name','area','description','type_id'), $request->geometry);
        return response()->json(['success' =>  $geoObject], self::HTTP_OK);
    }

    /**
     * Remove the specified geo object.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->geoObjectRepository->deleteGeoObject($id);
        return response()->json(null , self::HTTP_NO_CONTENT);
    }
}
