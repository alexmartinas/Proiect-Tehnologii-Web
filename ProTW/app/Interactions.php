<?php
/**
 * Created by PhpStorm.
 * User: Vladd
 * Date: 13.06.2017
 * Time: 4:31
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interactions extends Model
{
    protected $table = 'interactions';

    protected $fillable=[
        'id_child',
        'id_contact',
        'location_x',
        'location_y',
        'happened_at',
    ];
}