<?php

namespace AddressBundle;
use AddressBundle\AddressValidator;
use AddressBundle\AddressValidator\Apis;
use AddressBundle\Storage;
use \Infrastructure;

class AddressService
{
    private $validator;
    private $factory;

    public function __construct(Infrastructure\Application $app)
    {
        /* Api would be pulled from config ***************/
        //This really complicated unit testing

        //Service Locator Pattern

        $authId = 'ad4d7e15-b4b9-4113-a3f8-433d523366ec';
        $authToken = '7KtwURDrOoz3xSXcruej';
        $api = new Apis\SmartyStreets($authId, $authToken);
        /*************************************************/

        $cache = new Storage\Cache($app->cache);
        $persistence  = new Storage\Persistence($app->persistence);

        $this->validator = new AddressValidator\AddressValidator($api, $cache, $persistence);
        $this->factory = new Generic\AddressFactory();
    }

    public function getAddress($street, $city, $state, $zip)
    {
        $json = $this->validator->validateAddress($street, $city, $state, $zip);
        $address = $this->factory->createAddress($json);
        return $address;
    }

    public function getAllAddresses()
    {

    }
}