<?php

// https://jsonplaceholder.typicode.com/

require "vendor/autoload.php";

use GuzzleHttp\Client;

$payload  = ["title" => "foo", "body" => "bar", "userId" => 1]; 
$client   = new Client(['headers' => ['Content-Type: application/json']]);
$response = $client->request('post', "https://jsonplaceholder.typicode.com/posts", $payload);

var_dump($response->getHeader('content-length')[0]);
var_dump(gettype($response->getBody()));
