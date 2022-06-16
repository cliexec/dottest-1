<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    
    public $incementing = false;
    public $timestamps = false;

    protected $table = 'provinces';
    protected $primary_key = 'province_id';
    protected $fillable = ['province_id', 'province'];

}