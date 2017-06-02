<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $fillable=[
        'name',
        'gender',
        'age'
    ];
}
