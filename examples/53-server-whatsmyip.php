<?php

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

require __DIR__ . '/../vendor/autoload.php';

$http = new React\Http\HttpServer(function (ServerRequestInterface $request) {
    $body = "Your IP is: " . $request->getServerParams()['REMOTE_ADDR'];

    return new Response(
        StatusCodeInterface::STATUS_OK,
        array(
            'Content-Type' => 'text/plain'
        ),
        $body
    );
});

$socket = new React\Socket\SocketServer(isset($argv[1]) ? $argv[1] : '0.0.0.0:0');
$http->listen($socket);

echo 'Listening on ' . str_replace('tcp:', 'http:', $socket->getAddress()) . PHP_EOL;
