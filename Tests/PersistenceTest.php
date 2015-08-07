<?php

namespace AddressBundle\Tests;
use AddressBundle\Storage;
use Infrastructure\Application;
use Infrastructure\Persistence;
use PHPUnit_Framework_TestCase;

class PersistenceTest extends PHPUnit_Framework_TestCase
{
    //Test Engine
    private $persistence;

    //Tested Values
    private $street = '340 Main St';
    private $city = 'Venice';
    private $state = 'CA';
    private $zip = '90291';
    private $json = '{Json}';

    public function setUp()
    {
        $app = new Application();
        $this->persistence  = new Storage\Persistence($app->persistence);
    }

    public function testSaveAddressToPersistence()
    {
        $InsertedAddress = $this->persistence->saveAddress($this->street, $this->city, $this->state, $this->zip, $this->json);
        $this->assertJson($InsertedAddress);
    }

    public function testGetAddressFromPersistence()
    {
        $Address = $this->persistence->getAddress($this->street, $this->city, $this->state, $this->zip);
        $this->assertJson($Address);
    }

    public function testDeleteAddressFromPersistence()
    {
        $this->persistence->deleteAddress($this->street, $this->city, $this->state, $this->zip);
        $AddressEntity = $this->persistence->getAddress($this->street, $this->city, $this->state, $this->zip);
        $this->assertNull($AddressEntity);
    }
}
