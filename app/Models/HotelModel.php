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

    public function findAllWithParams(int $limit = PHP_INT_MAX, int $offset = 0, $country_id = 0, $city_id = 0, $sortBy = "price")
    {
        $builder = $this->db->table('prfx_hotels');
        $builder->select('prfx_hotels.address, prfx_hotels.latitude, prfx_hotels.id, prfx_hotels.hotel_name, prfx_hotels.star, prfx_hotels.longitude, prfx_attachments.url_from AS attachment_url, prfx_cities.city AS city_name, prfx_countries.country AS country_name, prfx_prices.price');
        $builder->join('prfx_attachments', 'prfx_attachments.id = prfx_hotels.attachment_id', 'left');
        $builder->join('prfx_cities', 'prfx_cities.id = prfx_hotels.city_id', 'left');
        $builder->join('prfx_countries', 'prfx_countries.id = prfx_hotels.country_id', 'left');
        $builder->join('prfx_prices', 'prfx_prices.hotel_id = prfx_hotels.id AND prfx_prices.cheapest_flag = 1', 'left');
        $builder->where('prfx_hotels.attachment_id <>', 0);
        if ($country_id > 0) {
            $builder->where('prfx_countries.id', $country_id);
        }
        if ($city_id > 0) {
            $builder->where('prfx_cities.id', $city_id);
        }
        if($sortBy == "price")
        {
            dd("prfx_prices.".$sortBy);
            $builder->orderBy("prfx_prices.".$sortBy, 'DESC');
        }
        else
        {
            $builder->orderBy("prfx_hotels.".$sortBy, 'DESC');
        }
        $builder->limit($limit, $offset);

        $query = $builder->get();
        $hotels = $query->getResult($this->returnType);

        return $hotels;
    }


    public function updateAttachmentId($id,$attachment_id)
    {
        $this->set('attachment_id', $attachment_id)->where('id', $id)->update();
    }
}