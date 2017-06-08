<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = 'children';

    protected $fillable=[
        'name',
        'gender',
        'device_id',
        'age',
        'location_x',
        'location_y'
    ];
}
