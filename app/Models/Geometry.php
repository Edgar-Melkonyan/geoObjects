<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Geometry extends Model
{
   /**
    * Save geometries after deletion.
    */
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'latitude', 'longitude', 'geo_object_id'];

    /**
     * The attributes that should be hidden from select.
     *
     * @var array
     */
    protected $hidden = ['geo_object_id', 'created_at', 'updated_at', 'deleted_at'];
}