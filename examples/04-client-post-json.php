<?php

use React\Http\Browser;
use Psr\Http\Message\ResponseInterface;

require __DIR__ . '/../vendor/autoload.php';

$client = new Browser();

$data = [
    'name' => [
        'first' => 'Alice',
        'name' => 'Smith'
    ],
    'email' => 'alice@example.com'
];

$client->post(
    'https://httpbingo.org/post',
    [
        'Content-Type' => 'application/json'
    ],
    json_encode($data)
)->then(function (ResponseInterface $response) {
    echo (string) $response->getBody();
}, function (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
});
