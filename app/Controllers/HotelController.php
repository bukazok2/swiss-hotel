<?php

namespace App\Controllers;

use App\Models\HotelModel;
use CodeIgniter\RESTful\ResourceController;

class HotelController extends ResourceController
{
    public function index()
    {
        $hotels = new HotelModel();
        return $this->respond($hotels->findAll(2,0));
    }
}
