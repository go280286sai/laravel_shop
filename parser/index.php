<?php
require_once __DIR__ . '/vendor/autoload.php';

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Http\Message\Response;
use React\Socket\SocketServer;



$server = "127.0.0.1";
$port = 3000;


$http = new HttpServer(function (ServerRequestInterface $request) {
//    $file = new DOMDocument();
//    $html = $file->loadHTML('https://www.php.net/');
//    $res = $html->getElementsByTagName('title')->item(0)->nodeValue;

    return React\Http\Message\Response::plaintext(
        "Hello World!\n"
    );
});

$socket = new SocketServer("{$server}:{$port}");
$http->listen($socket);

echo "Server running at {$server}:{$port}" . PHP_EOL;