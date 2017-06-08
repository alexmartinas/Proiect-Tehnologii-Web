<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointsOfInterest extends Model
{
    protected $table = 'points_of_interest';

    protected $fillable=[
        'id_child',
        'name'
    ];
}
