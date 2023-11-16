<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\InsertOrUpdateTrait;

class HotelModel extends Model
{
    use InsertOrUpdateTrait;
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'attachment_id',
        'ext_hotel_id',
        'country_id',
        'city_id',
        'address',
        'hotel_name',
        'latitude',
        'longitude',
        'star',
        'zip',
        "created_at",
        "updated_at",
    ];
}