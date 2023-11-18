<?php

namespace App\Controllers;

use App\Models\CountryModel;
use CodeIgniter\RESTful\ResourceController;

class CountriesController extends ResourceController
{
    public function index()
    {
        $countries = new CountryModel();
        return $this->respond($countries->findAll());
    }
}
