<?php

namespace App\Controllers;

use App\Models\CityModel;
use CodeIgniter\RESTful\ResourceController;

class CitiesController extends ResourceController
{
    public function index()
    {
        $cities = new CityModel();
        return $this->respond($cities->findAll());
    }
}
