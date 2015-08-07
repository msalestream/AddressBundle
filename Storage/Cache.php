<?php

namespace AddressBundle\Storage;

class Cache implements StorageBehavior
{
    private $cache;

    public function __construct(\Memcache $cache)
    {
        $this->cache = $cache;
    }

    public function getAddress($street, $city, $state, $zip)
    {
        return null;
    }

    public function saveAddress($street, $city, $state, $zip, $addressJson)
    {
        return null;
    }
    public function deleteAddress($street, $city, $state, $zip)
    {
        return null;
    }
}