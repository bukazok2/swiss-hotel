<?php

namespace App\Controllers;

use App\Models\HotelModel;

class HotelController extends BaseController
{
    public function index(): string
    {
        $hotels = new HotelModel();
        $hotels = $hotels->findAll();
        return json_encode($hotels);
    }
}
