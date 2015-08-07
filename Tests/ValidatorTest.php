<?php

namespace AddressBundle\Tests;
use AddressBundle;
use AddressBundle\AddressValidator;
use AddressBundle\Storage;
use Infrastructure\Persistence;
use PHPUnit_Framework_TestCase;

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    private $api;
    private $cache;
    private $persistence;

    private $validator;

    //Tested Values
    private $street = '340 Main St';
    private $city = 'Venice';
    private $state = 'CA';
    private $zip = '90291';
    private $json = '{Json}';

    public function __construct()
    {
        // Create a stub for the SomeClass class.
        $this->api = $this->getMockBuilder('AddressValidationInterface')
            ->getMock()
            ->method('getValidatedAddress')
            ->willReturn(false)
        ;


        $this->cache = $this->getMockBuilder('Cache')
            ->getMock()
            ->method('getAddressEntity')
            ->willReturn(false)
        ;

        //Not Working yet
        $mysql = new Persistence\Mysql();
        $mysql = $mysql->getConnection();
        $this->persistence  = new Storage\Persistence($mysql);
    }

    public function saveAddressToPersistence()
    {
        $this->persistence->saveAddressEntity($this->street, $this->city, $this->state, $this->zip, $this->json);
    }

    public function getAddressFromPersistence()
    {
        $address = $this->persistence->getAddressEntity($this->street, $this->city, $this->state, $this->zip);
        $this->assertInstanceOf('Address', $address);
    }

    public function deleteAddressFromPersistence()
    {
        $this->persistence->deleteAddressEntity($this->street, $this->city, $this->state, $this->zip);
        $address = $this->persistence->getAddressEntity($this->street, $this->city, $this->state, $this->zip);
        $this->assertNull($address);
    }
}
