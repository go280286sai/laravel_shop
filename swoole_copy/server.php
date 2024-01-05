<?php
include __DIR__ . '/html/vendor/autoload.php';
use OpenSwoole\Http\Server;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;
$server = new OpenSwoole\HTTP\Server("localhost", 9501,  OpenSwoole\Server::POOL_MODE, OpenSwoole\Constant::SOCK_TCP);
//$server->set([
//    'worker_num' => 2,      // The number of worker processes to start
////    'task_worker_num' => 1,  // The amount of task workers to start
//    'backlog' => 128,       // TCP backlog connection number
//]);
$server->on("start", function (Server $server) {
    echo "OpenSwoole http server is started\n";
});
$server->on('WorkerStart', function(OpenSwoole\Server $server, int $workerId)
{
    echo "Worker {$workerId} started\n";
});
$server->on('WorkerStop', function(OpenSwoole\Server $server, int $workerId)
{
    echo "Worker {$workerId} stopped\n";
});
$server->on("request", function (Request $request, Response $response){
        $name = $request->get['name'] ?? 'Guest';
        if($name == 'alex') {
            go(function () use ($request, $response, $name) {
                // Выполняем асинхронные операции, например, чтение данных из базы данных

                // Имитируем асинхронное чтение из базы данных
                Co::sleep(2); // имитация асинхронной задачи

                // Отправляем ответ клиенту
                $response->header("Content-Type", "text/plain");
                $response->end("Hello, Swoole! Data from database: $name");
            });
        } else{
            go(function () use ($request, $response, $name) {
                // Выполняем асинхронные операции, например, чтение данных из базы данных
                // Имитируем асинхронное чтение из базы данных
//                Co::sleep(2); // имитация асинхронной задачи

                // Отправляем ответ клиенту
                $response->header("Content-Type", "text/plain");
                $response->end("Hello, Swoole! Data from database: $name");
            });
        }

});
$server->start();