<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\InsertOrUpdateTrait;

class CountryModel extends Model
{
    use InsertOrUpdateTrait;

    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'country',
        'ext_country_id',
        "created_at",
        "updated_at",
    ];
}