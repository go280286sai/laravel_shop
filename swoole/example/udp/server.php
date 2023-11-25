<?php
$server = new OpenSwoole\Server('127.0.0.1', 9502, OpenSwoole\Server::POOL_MODE, OpenSwoole\Constant::SOCK_UDP);

// Setup the incoming data event callback, called 'Packet'
$server->on('Packet', function ($server, $data, $clientInfo)
{   $data = strtoupper($data);
    var_dump($clientInfo);
    $server->sendto($clientInfo['address'], $clientInfo['port'], "Server：{$data}");
});

// Start the server and begin accepting incoming requests
$server->start();