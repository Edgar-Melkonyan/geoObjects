<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoObject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'area', 'type_id'];

    /**
     * The attributes that should be hidden from select.
     *
     * @var array
     */
    protected $hidden = ['type_id', 'created_at', 'updated_at'];

    /**
     * GeoObject has many geometries
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public function geometry()
    {
        return $this->hasMany('App\Models\Geometry');
    }

    /**
     * GeoObject belongs to type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }
}