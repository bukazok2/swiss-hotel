<?php

namespace App\Entity;

use CodeIgniter\Entity\Entity;

class Hotel extends Entity
{
    public function setExt_hotel_id(string $hotel_id) : Hotel
    {
        $this->attributes['ext_hotel_id'] = intval($hotel_id);

        return $this;
    }

    public function setStar(string $star) : Hotel
    {
        $this->attributes['star'] = intval($star);

        return $this;
    }
}