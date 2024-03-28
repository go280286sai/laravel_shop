<?php

namespace Root\Parser\ui;
require_once "src/boot.php";

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Root\Parser\application\service\message\Send;

class Route
{

    /**
     * @param ...$routes
     * @return bool
     * @throws GuzzleException
     */
    public function add(...$routes): bool
    {
        $routes = $routes[0];
        if (!isset($routes['target']) && !isset($routes['token'])) {
            return false;
        }
        $token = htmlspecialchars(strip_tags($routes['token']));
        $target = ucfirst(htmlspecialchars(strip_tags($routes['target'])));
        $url = htmlspecialchars(strip_tags($routes['url']));
        try {
            $class = '\Root\Parser\ui\app\\' . $target;
            $execute = new $class;
            $execute->run($token, $url);
            $notification = new Send();
            $notification->post($target . ' created successfully!',
                'notification', false, URL_RETURN, $token);

            return true;
        } catch (Exception $e) {

            return false;
        }
    }
}
