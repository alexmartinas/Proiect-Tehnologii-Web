<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeofenceModel extends Model
{
    protected $table = 'geofences';

    protected $fillable=[
        'id_child',
        'id_user',
        'id_point',
        'distance'
    ];
}
