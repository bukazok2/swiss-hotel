<?php

namespace App\Controllers;

use Exception;
use \Config\Services;

use \CodeIgniter\HTTP\CURLRequest;
use \App\Services\DataProcessor;

class Fetch extends BaseController
{
    private string $endpoint = 'http://testapi.swisshalley.com/hotels/';
    private string $apiKey = 'b92189884ce200d55d403ccfe68f98f4';

    private CURLRequest $curl;
    private DataProcessor $procesor;

    public function __construct()
    {
        // as far as I know there is no built in dependecy injection in codeigniter
        $this->curl = Services::curlrequest();
        $this->procesor = new \App\Services\DataProcessor(); // TODO call throu Services
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
     
        $this->procesor->processData($response);

        return "success";
    }

    public function updateCache() : string
    {
        $this->procesor->updateCachedData();
        return "success";
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
