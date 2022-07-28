<?php

require_once __dir__.'/../vendor/autoload.php';

$api_key = "test_123";
$api_secret = "secret_123";

$gp = new  \Globalpayments\Php\API($api_key, $api_secret);

$response = $gp->CreateOrder(100, '12345', 'http://localhost:8000/callback', [
    'name' => 'John Doe',
    'email' => 'a@mcsam.in',
    'phone' => '1234567890',    
]);

var_dump($response);