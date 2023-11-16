<?php

namespace App\Entity;

use CodeIgniter\Entity\Entity;

class City extends Entity
{
    public function setExt_city_id(string $city_id) : City
    {
        $this->attributes['ext_city_id'] = intval($city_id);

        return $this;
    }
}