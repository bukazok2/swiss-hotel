<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'attachment_id',
        'hotel_id',
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