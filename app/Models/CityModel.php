<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\InsertOrUpdateTrait;

class CityModel extends Model
{
    use InsertOrUpdateTrait;

    protected $table = 'cities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'city',
        'ext_city_id',
        "created_at",
        "updated_at",
    ];
}