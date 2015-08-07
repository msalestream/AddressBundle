<?php

namespace AddressBundle\Tests;
use AddressBundle\AddressValidator;
use AddressBundle\Storage;
use AddressBundle\AddressValidator\Apis;
use Infrastructure\Persistence;
use PHPUnit_Framework_TestCase;

class PersistenceTest extends PHPUnit_Framework_TestCase
{
    private $validator;

    //Tested Values
    private $street = '340 Main St';
    private $city = 'Venice';
    private $state = 'CA';
    private $zip = '90291';

    public function setUp()
    {
        //Should be pulled off a config file.
        //But for time being we can put it here.
        $authId = 'ad4d7e15-b4b9-4113-a3f8-433d523366ec';
        $authToken = '7KtwURDrOoz3xSXcruej';
        $this->validator = new Apis\SmartyStreets($authId, $authToken);
    }

    public function testApiCallResponse()
    {
        $response = $this->validator->getValidatedAddress($this->street, $this->city, $this->state, $this->zip);
        $this->assertNotEmpty($response);
    }
}
