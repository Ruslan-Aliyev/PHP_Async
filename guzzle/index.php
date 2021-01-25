<?php

// https://jsonplaceholder.typicode.com/
$base_url = 'https://jsonplaceholder.typicode.com';
$path = '/posts';

require "vendor/autoload.php";

use GuzzleHttp\Client;

// $client = new Client([
//     'base_uri' => $base_url,
// ]);
  
// $response = $client->request('GET', $path, [
//     // 'query' => [
//     //     'param' => 'blah',
//     // ]
// ]);
 
// if ($response->getStatusCode() === 200)
// {
// 	$body = $response->getBody();
// 	$arr_body = json_decode($body);
// 	var_dump($arr_body);
// }

// ---

// $client = new Client([
//     'base_uri' => $base_url,
// ]);

// $response = $client->request('POST', $path, [
//     'json' => ["title" => "foo", "body" => "bar", "userId" => 1]
// ]);
 
// $body = $response->getBody();
// $arr_body = json_decode($body);
// var_dump($arr_body);

/*
 * Async
 */

$client = new Client();

// start request
$promise = $client->getAsync($base_url.$path)->then(
    function ($response) {
        return $response->getBody();
    }, function ($exception) {
        return $exception->getMessage();
    }
);
 
// do other things
echo '<b>This will not wait for the previous get request to finish to be displayed!</b>';
 
// wait for request to finish and display its response
$response = $promise->wait();
echo $response;

// ---

$client = new Client();

// start request
$promise = $client->postAsync($base_url.$path, [ 'json' => ["title" => "foo", "body" => "bar", "userId" => 1] ])->then(
    function ($response) {
        return $response->getBody();
    }, function ($exception) {
        return $exception->getMessage();
    }
);
 
// do other things
echo '<b>This will not wait for the previous post request to finish to be displayed!</b>';
 
// wait for request to finish and display its response
$response = $promise->wait();
echo $response;
