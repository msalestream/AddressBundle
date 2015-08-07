<?php

namespace AddressBundle\AddressValidator;

interface AddressValidationInterface {
    public function getValidatedAddress($street, $city, $state, $zip);
}