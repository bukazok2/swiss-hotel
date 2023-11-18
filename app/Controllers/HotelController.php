<?php

namespace App\Controllers;

use App\Models\HotelModel;
use CodeIgniter\RESTful\ResourceController;

class HotelController extends ResourceController
{
    public function index()
    {
        $validColumns = ['price', 'stars'];
        $itemsPerPage = 21;
        $filterByCountry = 0;
        $filterByCity = 0;
        $sortBy = 'price';

        if(isset($_GET['filterByCountry']))
        {
            $filterByCountry = $_GET['filterByCountry'];
        }

        if(isset($_GET['filterByCity']))
        {
            $filterByCity = $_GET['filterByCity'];
        }

        if(isset($_GET['itemsPerPage']))
        {
            $itemsPerPage = $_GET['itemsPerPage'];
        }

        if(isset($_GET['sortBy']))
        {
            if (!in_array($_GET['sortBy'], $validColumns)) 
            {
                $sortBy = 'price';
            }
            else
            {
                $sortBy = $_GET['sortBy'];
            }
        }
        
        $hotels = new HotelModel();
        return $this->respond($hotels->findAllWithParams($itemsPerPage,0,$filterByCountry,$filterByCity,$sortBy));
    }
}
