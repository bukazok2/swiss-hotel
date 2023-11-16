<?php

use App\Models\AttachmentsModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use CodeIgniter\Config\BaseService;
use App\Models\HotelModel;
use App\Models\PriceModel;
use App\Entities\Price;
use App\Entities\Country;
use App\Entities\City;
use App\Entities\Hotel;

class DataProcessor extends BaseService
{
    private HotelModel $hotelModel;
    private PriceModel $priceModel;
    private CountryModel $countryModel;
    private CityModel $cityModel;
    private AttachmentsModel $attachmentsModel;

    function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->priceModel = new PriceModel();
        $this->countryModel = new CountryModel();
        $this->cityModel = new CityModel();
        $this->attachmentsModel = new AttachmentsModel();
    }

    public function processData(array $response) : void
    {
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

            // City Entity
            $city = new City();
            $city->city = $resp['city'];
            $city->ext_city_id = $resp['city_id'];

            $city_id = $this->cityModel->insertOrUpdate("ext_city_id",$city);
            $country_id = $this->countryModel->insertOrUpdate("ext_country_id",$country);

            $hotel = new Hotel();
            $hotel->address = $resp['address'];
            $hotel->ext_hotel_id = $resp['hotel_id'];
            $hotel->hotel_name = $resp['hotel_name'];
            $hotel->latitude = $resp['latitude'];
            $hotel->longitude = $resp['longitude'];
            $hotel->star = $resp['star'];
            $hotel->zip = $resp['zip'];
            $hotel->country_id = $city_id;
            $hotel->city_id = $country_id;

            $hotel_id = $this->hotelModel->insertOrUpdate("ext_hotel_id",$hotel);

            $price->hotel_id = $hotel_id;
            $this->priceModel->insertOrUpdate("source",$price);
        }
    }
}