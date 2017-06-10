<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    protected $fillable=[
        'id_child',
        'id_user',
        'name',
        'description',
        'type',
        'accidenttype',
        'location_x',
        'location_y',
        'happened_at'
    ];
}
