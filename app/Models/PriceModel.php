<?php

namespace App\Models;

use CodeIgniter\Model;

class PriceModel extends Model
{
    protected $table = 'prices';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'hotel_id',
        'price',
        'source',
        "created_at",
        "updated_at",
    ];
}