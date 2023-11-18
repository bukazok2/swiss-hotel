<?php

namespace App\Services;

use App\Entity\Attachment;
use App\Models\AttachmentsModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use CodeIgniter\Config\BaseService;
use App\Models\HotelModel;
use App\Models\PriceModel;
use App\Entity\Price;
use App\Entity\Country;
use App\Entity\City;
use App\Entity\Hotel;
use \CodeIgniter\HTTP\CURLRequest;
use \Config\Services;
use Exception;

use function PHPUnit\Framework\containsOnly;

class DataProcessor extends BaseService
{
    private HotelModel $hotelModel;
    private PriceModel $priceModel;
    private CountryModel $countryModel;
    private CityModel $cityModel;
    private AttachmentsModel $attachmentsModel;
    private CURLRequest $curl; 

    function __construct()
    {
        $this->curl = Services::curlrequest();
        $this->hotelModel = new HotelModel();
        $this->priceModel = new PriceModel();
        $this->countryModel = new CountryModel();
        $this->cityModel = new CityModel();
        $this->attachmentsModel = new AttachmentsModel();
    }

    public function processData(array $response) : void
    {
        $this->hotelModel->truncate();
        $this->priceModel->truncate();
        $this->countryModel->truncate();
        $this->cityModel->truncate();
        $this->attachmentsModel->truncate();

        
        foreach($response["data"]["hotels"] as $resp)
        {
            $price = new Price();
            $price->price = $resp['price'];
            $price->source = $resp['source'];
            $price->cheapest_flag = 0;
            $price->hotel_id = "";

            $country = new Country();
            $country->country = $resp['country'];
            $country->ext_country_id = $resp['country_id'];

            $city = new City();
            $city->city = $resp['city'];
            $city->ext_city_id = $resp['city_id'];

            $city_id = $this->cityModel->insertOrUpdate(array("ext_city_id"),$this->cityModel,$city);
            $country_id = $this->countryModel->insertOrUpdate(array("ext_country_id"),$this->countryModel,$country);

            $hotel = new Hotel();
            $hotel->address = $resp['address'];
            $hotel->ext_hotel_id = $resp['hotel_id'];
            $hotel->hotel_name = $resp['hotel_name'];
            $hotel->latitude = $resp['latitude'];
            $hotel->longitude = $resp['longitude'];
            $hotel->star = $resp['star'];
            $hotel->zip = $resp['zip'];
            $hotel->country_id = $country_id;
            $hotel->city_id = $city_id;

            $attachment = new Attachment();
            $attachment->url_from = $resp['image'];
            $attachment_id = $this->attachmentsModel->insertOrUpdate(array("id"),$this->attachmentsModel,$attachment);
            
            $price->attachment_id = $attachment_id;

            $hotel->attachment_id = 0;

            $hotel_id = $this->hotelModel->insertOrUpdate(array("ext_hotel_id"),$this->hotelModel,$hotel);

            $price->hotel_id = $hotel_id;
            $this->priceModel->insertOrUpdate(array("source","hotel_id"),$this->priceModel,$price);
        }
    }

    public function updateCachedData()
    {
        $this->priceModel->updateCheapestFlag();

        $prices = $this->priceModel->findWithAttachments();

        foreach($prices as $price)
        {
            if($price->cheapest_flag != 1)
                continue;
        
            $attachment_id = 0;
            if(!$this->isImageBroken($price->attachment_url))
            {
                $attachment_id = $price->attachment_id;
            }
            else
            {
                $attachment_id = $this->findFallbackImage($price->hotel_id,$prices);
            }

            $this->hotelModel->updateAttachmentId($price->hotel_id,$attachment_id);
        }
    }

    private function findFallbackImage(int $hotel_id,array $prices) : int
    {
        foreach($prices as $price)
        {
            if($price->cheapest_flag != 0 && $price->hotel_id != $hotel_id)
                continue;
        
            if(!$this->isImageBroken($price->attachment_url))
            {
                return $price->attachment_id;
            }
        }

        return 0;
    }
    

    private function isImageBroken($image) : bool
    {
        if(!$image)
            return true;

        try
        {
            $response = $this->curl->request('get', $image);

            $statusCode = $response->getStatusCode();

            if ($statusCode >= 200 && $statusCode < 300) {
                return false;
            } else {
                return true;
            }
        }
        catch(Exception $e)
        {
           
        }
        return true;
    }
}