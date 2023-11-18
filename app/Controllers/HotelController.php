<?php

namespace App\Controllers;

use App\Models\HotelModel;
use CodeIgniter\RESTful\ResourceController;

class HotelController extends ResourceController
{
    public function index()
    {
        $validColumns = ['price', 'star'];
        $itemsPerPage = 21;
        $filterByCountry = 0;
        $filterByCity = 0;
        $sortBy = 'price';

        $filterByCountry = $_GET['filterByCountry'] ?? 0;
        $filterByCity = $_GET['filterByCity'] ?? 0;
        $itemsPerPage = $_GET['itemsPerPage'] ?? 21;
        $sortBy = in_array($_GET['sortBy'] ?? '', $validColumns) ? $_GET['sortBy'] : 'price';
        $currentPage = $_GET['currentPage'] ?? 1;
        $offset = ($currentPage - 1) * $itemsPerPage;

        $hotels = new HotelModel();
        return $this->respond($hotels->findAllWithParams($itemsPerPage,$offset,$filterByCountry,$filterByCity,$sortBy));
    }
}
