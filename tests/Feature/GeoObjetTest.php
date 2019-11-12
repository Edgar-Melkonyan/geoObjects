<?php

namespace Tests\Feature;

use App\Models\Type;
use App\Models\GeoObject;
use App\Models\Geometry;
use Tests\TestCase;

class GeoObjetTest extends TestCase
{
    /*
     * Test GeoObject created correctly
     *
     * @method POST
     */
    public function testsGeoObjectCreatedCorrectly()
    {
        $geometry = [
            0 => [
                'type'      => 'Geometry Type First',
                'latitude'  => 24.212,
                'longitude' => 11.212
            ],
            1 => [
                'type'      => 'Geometry Type Second',
                'latitude'  => 26.212,
                'longitude' => 12.212
            ],
        ];
        $type = factory(Type::class)->create();
        $payload = [
            'name'                   => 'name',
            'description'            => 'description',
            'type_id'                => $type->id,
            'geometry'               => $geometry,
        ];
        $this->json('POST', '/api/geo_objects', $payload)
            ->assertStatus(201)
            ->assertJson([
                'success' => [
                    'id' => 1,
                    'name' => $payload['name'],
                    'description' => $payload['description'],
                    'area' => 0,
                    'type' => [
                        'id'    => $type->id,
                        'name'  => $type->name
                    ],
                    'geometry' => [
                        0 => [
                            'id'        => 1,
                            'type'      => $geometry[0]['type'],
                            'latitude'  => $geometry[0]['latitude'],
                            'longitude' => $geometry[0]['longitude'],
                        ],
                        1 => [
                            'id'        => 2,
                            'type'      => $geometry[1]['type'],
                            'latitude'  => $geometry[1]['latitude'],
                            'longitude' => $geometry[1]['longitude'],
                        ],
                    ]
                ]
            ]);
    }

    /*
     * Test GeoObject listed correctly
     *
     * @method GET
     */
    public function testGeoObjectListedCorrectly()
    {
        $geoObject = factory(GeoObject::class)->create();
        $geometry  = factory(Geometry::class, 3)->create([
            'geo_object_id' => $geoObject->id,
        ]);
        $this->json('GET', '/api/geo_objects/'.$geoObject->id, [])
            ->assertStatus(200)
            ->assertJson([
                'success' => [
                    'id' => $geoObject->id,
                    'name' => $geoObject->name,
                    'description' => $geoObject->description,
                    'area' => $geoObject->area,
                    'type' => [
                        'id'    => $geoObject->type->id,
                        'name'  => $geoObject->type->name
                    ],
                    'geometry' => [
                        0 => [
                            'id'        => $geometry[0]['id'],
                            'type'      => $geometry[0]['type'],
                            'latitude'  => $geometry[0]['latitude'],
                            'longitude' => $geometry[0]['longitude'],
                        ],
                        1 => [
                            'id'        => $geometry[1]['id'],
                            'type'      => $geometry[1]['type'],
                            'latitude'  => $geometry[1]['latitude'],
                            'longitude' => $geometry[1]['longitude'],
                        ],
                        2 => [
                            'id'        => $geometry[2]['id'],
                            'type'      => $geometry[2]['type'],
                            'latitude'  => $geometry[2]['latitude'],
                            'longitude' => $geometry[2]['longitude'],
                        ],
                    ]
                ]
            ]);
    }

    /*
     * Test GeoObjects listed correctly
     *
     * @method GET
     */
    public function testGeoObjectsListedCorrectly()
    {
        $geoObject = factory(GeoObject::class, 2 )->create();
        $geometryFirstObject  = factory(Geometry::class, 3)->create([
            'geo_object_id' => $geoObject[0]->id,
        ]);
        $geometrySecondObject  = factory(Geometry::class, 3)->create([
            'geo_object_id' => $geoObject[1]->id,
        ]);
        $this->json('GET', '/api/geo_objects/', [])
            ->assertStatus(200)
            ->assertJson([
                'success' => [
                    'data' => [
                        [
                            'id' => $geoObject[0]['id'],
                            'name' =>$geoObject[0]['name'],
                            'description' => $geoObject[0]['description'],
                            'area' => $geoObject[0]['area'],
                            'type' => [
                                'id'    => $geoObject[0]->type->id,
                                'name'  => $geoObject[0]->type->name
                            ],
                            'geometry' => [
                                0 => [
                                    'id'        => $geometryFirstObject[0]['id'],
                                    'type'      => $geometryFirstObject[0]['type'],
                                    'latitude'  => $geometryFirstObject[0]['latitude'],
                                    'longitude' => $geometryFirstObject[0]['longitude'],
                                ],
                                1 => [
                                    'id'        => $geometryFirstObject[1]['id'],
                                    'type'      => $geometryFirstObject[1]['type'],
                                    'latitude'  => $geometryFirstObject[1]['latitude'],
                                    'longitude' => $geometryFirstObject[1]['longitude'],
                                ],
                                2 => [
                                    'id'        => $geometryFirstObject[2]['id'],
                                    'type'      => $geometryFirstObject[2]['type'],
                                    'latitude'  => $geometryFirstObject[2]['latitude'],
                                    'longitude' => $geometryFirstObject[2]['longitude'],
                                ],
                            ]
                        ],
                        [
                        'id'            => $geoObject[1]['id'],
                        'name'          => $geoObject[1]['name'],
                        'description'   => $geoObject[1]['description'],
                        'area'          => $geoObject[1]['area'],
                        'type' => [
                            'id'    => $geoObject[1]->type->id,
                            'name'  => $geoObject[1]->type->name
                        ],
                        'geometry' => [
                            0 => [
                                'id'        => $geometrySecondObject[0]['id'],
                                'type'      => $geometrySecondObject[0]['type'],
                                'latitude'  => $geometrySecondObject[0]['latitude'],
                                'longitude' => $geometrySecondObject[0]['longitude'],
                            ],
                            1 => [
                                'id'        => $geometrySecondObject[1]['id'],
                                'type'      => $geometrySecondObject[1]['type'],
                                'latitude'  => $geometrySecondObject[1]['latitude'],
                                'longitude' => $geometrySecondObject[1]['longitude'],
                            ],
                            2 => [
                                'id'        => $geometrySecondObject[2]['id'],
                                'type'      => $geometrySecondObject[2]['type'],
                                'latitude'  => $geometrySecondObject[2]['latitude'],
                                'longitude' => $geometrySecondObject[2]['longitude'],
                            ],
                        ]
                    ]
                ]
            ]
        ]);
    }

    /*
     * Test GeoObject's Geometries listed correctly
     *
     * @method GET
     */
    public function testGeoObjectGeometriesListedCorrectly()
    {
        $geoObject = factory(GeoObject::class)->create();
        $geometry  = factory(Geometry::class)->create([
            'geo_object_id' => $geoObject->id,
        ]);
        $this->json('GET', '/api/geo_objects/'.$geoObject->id.'/geometries', [])
            ->assertStatus(200)
            ->assertJson([
                'success' => [
                    'id' => $geoObject->id,
                    'name' => $geoObject->name,
                    'description' => $geoObject->description,
                    'area' => $geoObject->area,
                    'type' => [
                        'id'    => $geoObject->type->id,
                        'name'  => $geoObject->type->name
                    ],
                    'geometry' => [
                        0 => [
                            'id'        => $geometry->id,
                            'type'      => $geometry->type,
                            'latitude'  => $geometry->latitude,
                            'longitude' => $geometry->longitude,
                        ],
                    ]
                ]
            ]);
    }

    /*
     * Test GeoObject updated correctly
     *
     * @method PUT
     */
    public function testsGeoObjectUpdatedCorrectly()
    {
        $type = factory(Type::class)->create();
        $geoObject = factory(GeoObject::class)->create();
        $geometry  = factory(Geometry::class, 3)->create([
            'geo_object_id' => $geoObject->id,
        ]);
        $payload = [
            'name'         => 'name updated',
            'description'  => 'description updated',
            'type_id'      => $type->id,
            'geometry'     => $geometry,
        ];
        $this->json('PUT', '/api/geo_objects/' . $geoObject->id, $payload)
            ->assertStatus(200)
            ->assertJson([
                'success' => [
                    'id'            => $geoObject->id,
                    'name'          => $payload['name'],
                    'description'   => $payload['description'],
                    'type' => [
                        'id'    => $type->id,
                        'name'  => $type->name
                    ],
                    'geometry' => [
                        0 => [
                            'type'      => $geometry[0]['type'],
                            'latitude'  => $geometry[0]['latitude'],
                            'longitude' => $geometry[0]['longitude'],
                        ],
                        1 => [
                            'type'      => $geometry[1]['type'],
                            'latitude'  => $geometry[1]['latitude'],
                            'longitude' => $geometry[1]['longitude'],
                        ],
                        2 => [
                            'type'      => $geometry[2]['type'],
                            'latitude'  => $geometry[2]['latitude'],
                            'longitude' => $geometry[2]['longitude'],
                        ],
                    ]
                ]
            ]);
    }

    /*
     * Test GeoObject deleted correctly
     *
     * @method DELETE
     */
    public function testsGeoObjectDeletedCorrectly()
    {
        $this->json('DELETE', '/api/geo_objects/' . factory(GeoObject::class)->create()->id, [])
            ->assertStatus(204);
    }
}
