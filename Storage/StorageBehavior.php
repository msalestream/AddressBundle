<?php

namespace AddressBundle\Storage;

interface StorageBehavior
{
    public function getAddress($street, $city, $state, $zip);
    public function saveAddress($street, $city, $state, $zip, $addressJson);
    public function deleteAddress($street, $city, $state, $zip);
}