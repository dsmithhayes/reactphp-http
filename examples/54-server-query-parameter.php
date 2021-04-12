<?php

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

require __DIR__ . '/../vendor/autoload.php';

$http = new React\Http\HttpServer(function (ServerRequestInterface $request) {
    $queryParams = $request->getQueryParams();

    $body = 'The query parameter "foo" is not set. Click the following link ';
    $body .= '<a href="/?foo=bar">to use query parameter in your request</a>';

    if (isset($queryParams['foo'])) {
        $body = 'The value of "foo" is: ' . htmlspecialchars($queryParams['foo']);
    }

    return new Response(
        StatusCodeInterface::STATUS_OK,
        array(
            'Content-Type' => 'text/html'
        ),
        $body
    );
});

$socket = new React\Socket\SocketServer(isset($argv[1]) ? $argv[1] : '0.0.0.0:0');
$http->listen($socket);

echo 'Listening on ' . str_replace('tcp:', 'http:', $socket->getAddress()) . PHP_EOL;
