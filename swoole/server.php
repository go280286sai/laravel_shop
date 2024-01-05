<?php
include __DIR__ . '/vendor/autoload.php';

use OpenSwoole\Http\Server;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;
use Root\Parser\application\ListCategoriesApp;
use Root\Parser\application\TitleApp;

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
        try {
            $title = new TitleApp('https://bi.ua/ukr/konstruktori/');
            $res = $title->get();
            $file = fopen("data.txt", "w");
            fwrite($file, json_encode($res));
            $list = new ListCategoriesApp("https://bi.ua/ukr/konstruktori/");
            $result = $list->get();
            foreach ($result as $key => $value) {
                fwrite($file, $value['title']. "\n" . $value['url'] . "\n");
            }
            fclose($file);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            $res = "Error: " . $e->getMessage();
        }

        $response->header("Content-Type", "text/plain");
        $response->header("Charset", "UTF-8");
        $response->end("Hello, Swoole! Data from database: $res");
    });
});
$server->start();