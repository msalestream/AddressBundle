<?php

namespace AddressBundle\Generic;

class AddressFactory
{
    public function createAddress($addressData)
    {
        return new Address($addressData);
    }
}