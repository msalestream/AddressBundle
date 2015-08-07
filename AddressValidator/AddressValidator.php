<?php

namespace AddressBundle\AddressValidator;
use AddressBundle\Storage;
use AddressBundle\AddressValidator\Apis;


class AddressValidator
{
    private $api;
    private $cache;
    private $persistence;

    public function __construct(AddressValidationInterface $api, Storage\StorageBehavior $cache, Storage\StorageBehavior $persistence)
    {
        $this->api = $api;
        $this->cache = $cache;
        $this->persistence = $persistence;
    }

    public function validateAddress($street, $city, $state, $zip)
    {
        $addressJson = $this->cache->getAddress($street, $city, $state, $zip);

        if($addressJson)
        {
            $addressJson = $this->persistence->getAddress($street, $city, $state, $zip);
            $this->cache->saveAddress($street, $city, $state, $zip, $addressJson);
        }

        if($addressJson)
        {
            $addressJson = $this->api->getValidatedAddress($street, $city, $state, $zip);
            $this->persistence->saveAddress($street, $city, $state, $zip, $addressJson);
        }

        return $addressJson;
    }
}