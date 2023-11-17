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
        "attachment_id",
        "created_at",
        "updated_at",
    ];
    protected $returnType    = \App\Entity\Price::class;

    public function updateCheapestFlag()
    {
        $subquery = $this->select('MIN(price) as min_price, hotel_id')
                        ->groupBy('hotel_id')
                        ->get();

        foreach ($subquery->getResult() as $row) {
            $this->set('cheapest_flag', 1)
                 ->where('hotel_id', $row->hotel_id)
                 ->where('price', $row->min_price)
                 ->limit(1)
                 ->update();
        }
    }

    public function findWithAttachments()
    {
        $sql = "
            SELECT prfx_prices.*,
                prfx_attachments.url_from AS attachment_url
            FROM prfx_prices
            LEFT JOIN prfx_attachments ON prfx_attachments.id = prfx_prices.attachment_id
        ";

        $query = $this->db->query($sql);
        $prices = $query->getResult($this->returnType);

        return $prices;
    }

}