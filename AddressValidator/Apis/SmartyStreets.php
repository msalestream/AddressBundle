<?php

namespace AddressBundle\AddressValidator\Apis;
use AddressBundle\AddressValidator;
use AddressBundle\Storage;

class SmartyStreets implements AddressValidator\AddressValidationInterface
{
    private $authId;
    private $authToken;

    public function __construct($authId, $authToken)
    {
        $this->authId = urlencode($authId);
        $this->authToken = urlencode($authToken);
    }

    public function getValidatedAddress($street, $city, $state, $zip)
    {
        $street = urlencode($street);
        $city   = urlencode($city);
        $state  = urlencode($state);
        $zip    = urlencode($zip);

        $req = "https://api.smartystreets.com/street-address/?street={$street}&city={$city}&state={$state}&zip={$zip}&auth-id={$this->authId}&auth-token={$this->authToken}";
        $response = file_get_contents($req);

        return json_decode($response);
    }
}