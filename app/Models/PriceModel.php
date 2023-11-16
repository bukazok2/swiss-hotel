<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\InsertOrUpdateTrait;

class PriceModel extends Model
{
    use InsertOrUpdateTrait;

    protected $table = 'prices';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'hotel_id',
        'price',
        'source',
        "cheapest_flag",
        "created_at",
        "updated_at",
    ];
}