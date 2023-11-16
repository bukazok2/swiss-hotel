<?php

namespace App\Controllers;

use Exception;
use \Config\Services;
use \App\Models\HotelModel;
use \CodeIgniter\HTTP\CURLRequest;

class Fetch extends BaseController
{
    private string $endpoint = 'http://testapi.swisshalley.com/hotels/';
    private string $apiKey = 'b92189884ce200d55d403ccfe68f98f4';

    private CURLRequest $curl;
    private HotelModel $hotelModel;

    public function __construct()
    {
        // as far as I know there is no built in dependecy injection in codeigniter
        $this->curl = Services::curlrequest();
        $this->hotelModel = new HotelModel();
    }

    public function index(): string
    {
        $response = array();
        try
        {
            $response = $this->fetchFromUrl($this->endpoint);
        }
        catch(Exception $e)
        {
            return "e:" . $e->getMessage();
        }
     
        $this->processResponse($response);

        return "success";
    }

    private function processResponse(array $response) : void
    {
        foreach($response["data"]["hotels"] as $resp)
        {
            $hotel = array(
                'address' => $resp['address'],
                'hotel_id' => intval($resp['hotel_id']),
                'hotel_name' => $resp['hotel_name'],
                'latitude' => $resp['latitude'],
                'longitude' => $resp['longitude'],
                'star' => intval($resp['star']),
                'zip' => $resp['zip'],
            );

            $existingHotel = $this->hotelModel->where('hotel_id', $hotel['hotel_id'])->first();

            if ($existingHotel) 
            {
                $this->hotelModel->update($existingHotel['id'], $hotel);
                log_message('info', 'Hotel updated successfully: ' . $hotel['hotel_id']);
            } 
            else 
            {
                $this->hotelModel->insert($hotel);
                log_message('info', 'Hotel inserted successfully: ' . $hotel['hotel_id']);
            }
        }
    }

    private function fetchFromUrl(string $url): array
    {
        try 
        {
            $this->curl->setHeader("X-API-KEY",$this->apiKey);
            $response = $this->curl->request('get', $url)->getBody();
            return json_decode($response, true);
        } 
        catch (\Exception $e) 
        {
            throw new Exception($e->getMessage());
        }
    }
}
