<?php

namespace AddressBundle\Generic;

class Address
{
    public $data;

    public function __construct($addressData)
    {
        $this->data = $addressData;
    }
}