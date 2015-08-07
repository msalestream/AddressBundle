<?php

namespace AddressBundle\Storage;

class Persistence implements StorageBehavior
{
    private $dbh;

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function getAddress($street, $city, $state, $zip)
    {
        $sql = "
            SELECT *
            FROM address
            WHERE street = ?
            AND city = ?
            AND state = ?
            AND zip = ?
            LIMIT 1
        ";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(1, $street);
        $sth->bindParam(2, $city);
        $sth->bindParam(3, $state);
        $sth->bindParam(4, $zip);

        $sth->execute();
        $results = $sth->fetch();

        return isset($results['address_json']) ? $results['address_json'] : null;
    }

    public function saveAddress($street, $city, $state, $zip, $addressJson)
    {
        $sql = "
            INSERT INTO address (street, city, state, zip, address_json)
            VALUES (?, ?, ?, ?, ?)
        ";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(1, $street);
        $sth->bindParam(2, $city);
        $sth->bindParam(3, $state);
        $sth->bindParam(4, $zip);
        $sth->bindParam(5, $addressJson);
        $sth->execute();

        return $addressJson;
    }

    public function deleteAddress($street, $city, $state, $zip)
    {
        $sql = "
            DELETE FROM address
            WHERE street = ?
            AND city = ?
            AND state = ?
            AND zip = ?
        ";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(1, $street);
        $sth->bindParam(2, $city);
        $sth->bindParam(3, $state);
        $sth->bindParam(4, $zip);
        $sth->execute();
    }
}