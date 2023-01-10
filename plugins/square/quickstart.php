<?php

require 'vendor/autoload.php';

use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;
// echo "<pre>";
// print_r(getenv());
// print_r([
//     'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
//     'environment' => Environment::SANDBOX,
// ]);

// die();
$client = new SquareClient([
    'accessToken' => 'EAAAEDJ6PPGsLGFJAcDxo1jPNwK6aDE-RY8Jl5V5hCLhtbpT1KXWjPyvMc_MELvS',
    'environment' => Environment::SANDBOX,
]);

// $client = new SquareClient ([
//     'accessToken' => getenv('ACCESS_TOKEN'),
//     'environment' => Environment::SANDBOX,
// ]);

try {

    $apiResponse = $client->getLocationsApi()->listLocations();

    if ($apiResponse->isSuccess()) {
        $result = $apiResponse->getResult();
        foreach ($result->getLocations() as $location) {
            printf(
                "%s: %s, %s, %s<p/>", 
                $location->getId(),
                $location->getName(),
                $location->getAddress()->getAddressLine1(),
                $location->getAddress()->getLocality()
            );
        }

    } else {
        $errors = $apiResponse->getErrors();
        foreach ($errors as $error) {
            printf(
                "%s<br/> %s<br/> %s<p/>", 
                $error->getCategory(),
                $error->getCode(),
                $error->getDetail()
            );
        }
    }

} catch (ApiException $e) {
    echo "ApiException occurred: <b/>";
    echo $e->getMessage() . "<p/>";
}
// set SQUARE_ACCESS_TOKEN=EAAAEDJ6PPGsLGFJAcDxo1jPNwK6aDE-RY8Jl5V5hCLhtbpT1KXWjPyvMc_MELvS
