<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'city',
        'city_id',
        "created_at",
        "updated_at",
    ];
}