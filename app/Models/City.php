<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    
    public $incementing = false;
    public $timestamps = false;

    protected $table = 'cities';
    protected $primary_key = 'city_id';
    protected $fillable = [
        'city_id', 
        'province_id', 
        'province',
        'type',
        'city_name',
        'postal_code'
    ];

}