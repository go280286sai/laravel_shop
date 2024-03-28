<?php
include __DIR__ . '/vendor/autoload.php';

use OpenSwoole\Http\Server;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;

$server = new OpenSwoole\HTTP\Server("localhost", 9501, OpenSwoole\Server::POOL_MODE, OpenSwoole\Constant::SOCK_TCP);
//$server->set([
//    'worker_num' => 2,      // The number of worker processes to start
////    'task_worker_num' => 1,  // The amount of task workers to start
//    'backlog' => 128,       // TCP backlog connection number
//]);
$server->on("start", function (Server $server) {
    echo "OpenSwoole http server is started\n";
});
$server->on('WorkerStart', function (OpenSwoole\Server $server, int $workerId) {
    echo "Worker {$workerId} started\n";
});
$server->on('WorkerStop', function (OpenSwoole\Server $server, int $workerId) {
    echo "Worker {$workerId} stopped\n";
});

$server->on("request", function (Request $request, Response $response) {
    go(function () use ($request, $response) {
        if ($request->getMethod() == 'POST') {
            $response->header("Content-Type", "text/json");
            $response->header("Charset", "UTF-8");
            $response->end("{'status':'accepted'}");
            $run = new \Root\Parser\ui\Route();
            $run->add($request->post);
        } else {
            $response->status(403);
            $response->end("{'status':'forbidden'}");
        }
    });
});
$server->start();