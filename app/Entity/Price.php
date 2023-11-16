<?php

namespace App\Entity;

use CodeIgniter\Entity\Entity;

class Price extends Entity
{
    public function setPrice(string $price) : Price
    {
        $floatPrice = floatval($price);
        $roundedPrice = ceil($floatPrice); // Round up to the nearest integer

        $this->attributes['price'] = $roundedPrice;

        return $this;
    }
}