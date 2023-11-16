<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Country extends Entity
{
    /*
    protected $allowedFields = [
        'id',
        'country',
        'ext_country_id',
        "created_at",
        "updated_at",
    ];*/

    public function setExt_country_id(string $country_id) : Country
    {
        $this->attributes['ext_country_id'] = intval($country_id);

        return $this;
    }

}