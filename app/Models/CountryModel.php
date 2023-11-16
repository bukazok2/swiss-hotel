<?php

namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model
{
    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'country',
        'country_id',
        "created_at",
        "updated_at",
    ];
}