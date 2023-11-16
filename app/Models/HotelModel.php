<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\ModelExtTrait;

class HotelModel extends Model
{
    use ModelExtTrait;
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
    protected $returnType    = \App\Entity\Hotel::class;

    public function findAll(int $limit = PHP_INT_MAX,int $offset = 0)
    {
        $sql = "
            SELECT prfx_hotels.*,
                prfx_attachments.url_from AS attachment_url, 
                prfx_cities.city AS city_name, 
                prfx_countries.country AS country_name
            FROM prfx_hotels
            LEFT JOIN prfx_attachments ON prfx_attachments.id = prfx_hotels.attachment_id
            LEFT JOIN prfx_cities ON prfx_cities.id = prfx_hotels.city_id
            LEFT JOIN prfx_countries ON prfx_countries.id = prfx_hotels.country_id
            LIMIT ? OFFSET ?
        ";

        $query = $this->db->query($sql, [$limit, $offset]);
        $hotels = $query->getResult($this->returnType);

        return $hotels;
    }
}