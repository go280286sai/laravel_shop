<?php
declare(strict_types=1);
/**
 * This file is part of OpenSwoole.
 * @link     https://openswoole.com
 * @contact  hello@openswoole.com
 */
$client = new OpenSwoole\Client(\OpenSwoole\Constant::SOCK_TCP, \OpenSwoole\Constant::SOCK_SYNC);
$client->connect('127.0.0.1', 9501);
$client->send("Hello World\n");
echo $client->recv() . "\n";
sleep(1);

//netcat -u 127.0.0.1 9502