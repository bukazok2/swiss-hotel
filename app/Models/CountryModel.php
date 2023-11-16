<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\ModelExtTrait;

class CountryModel extends Model
{
    use ModelExtTrait;

    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'country',
        'ext_country_id',
        "created_at",
        "updated_at",
    ];
    protected $returnType    = \App\Entity\Country::class;
}