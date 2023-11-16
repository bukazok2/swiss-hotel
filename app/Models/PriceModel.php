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

    public function updateCheapestFlag()
    {
        $subquery = $this->select('MIN(price) as min_price, hotel_id')
                        ->groupBy('hotel_id')
                        ->get();

        foreach ($subquery->getResult() as $row) {
            $this->set('cheapest_flag', 1)
                 ->where('hotel_id', $row->hotel_id)
                 ->where('price', $row->min_price)
                 ->update();
        }
    }
}