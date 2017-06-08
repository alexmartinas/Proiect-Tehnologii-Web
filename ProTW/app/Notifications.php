<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    protected $fillable=[
        'id_child',
        'description',
        'location_x',
        'location_y',
        'happened_at'
    ];
}
