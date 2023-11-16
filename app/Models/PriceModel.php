<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\ModelExtTrait;

class PriceModel extends Model
{
    use ModelExtTrait;

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
    protected $returnType    = \App\Entity\Price::class;
}