<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\ModelExtTrait;

class CityModel extends Model
{
    use ModelExtTrait;

    protected $table = 'cities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'city',
        'ext_city_id',
        "created_at",
        "updated_at",
    ];
    protected $returnType    = \App\Entity\City::class;
}