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

    public function findAllWithParams(int $limit = PHP_INT_MAX, int $offset = 0, int $country_id = 0,int $city_id = 0, string $sortBy = "price") : array
    {
        $baseBuilder = $this->db->table('prfx_hotels');
        $baseBuilder->select('prfx_hotels.address, prfx_hotels.latitude, prfx_hotels.id, prfx_hotels.hotel_name, prfx_hotels.star, prfx_hotels.longitude, prfx_attachments.url_from AS attachment_url, prfx_cities.city AS city_name, prfx_countries.country AS country_name, prfx_prices.price');
        $baseBuilder->join('prfx_attachments', 'prfx_attachments.id = prfx_hotels.attachment_id', 'left');
        $baseBuilder->join('prfx_cities', 'prfx_cities.id = prfx_hotels.city_id', 'left');
        $baseBuilder->join('prfx_countries', 'prfx_countries.id = prfx_hotels.country_id', 'left');
        $baseBuilder->join('prfx_prices', 'prfx_prices.hotel_id = prfx_hotels.id AND prfx_prices.cheapest_flag = 1', 'left');
        $baseBuilder->where('prfx_hotels.attachment_id <>', 0);
        if ($country_id > 0) {
            $baseBuilder->where('prfx_countries.id', $country_id);
        }
        if ($city_id > 0) {
            $baseBuilder->where('prfx_cities.id', $city_id);
        }

        $countBuilder = clone $baseBuilder;
        $countBuilder->select('COUNT(*) as total');
        $total = $countBuilder->countAllResults(false);

        $dataBuilder = clone $baseBuilder;
        $dataBuilder->orderBy($sortBy, 'DESC');
        $dataBuilder->limit($limit, $offset);

        $query = $dataBuilder->get();
        $hotels = $query->getResult($this->returnType);

        return [
            'data' => $hotels,
            'total' => $total,
        ];
    }

    public function updateAttachmentId($id,$attachment_id)
    {
        $this->set('attachment_id', $attachment_id)->where('id', $id)->update();
    }
}