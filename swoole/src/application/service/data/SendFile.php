<?php

namespace Root\Parser\application\service\data;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Root\Parser\application\service\message\Send;


class SendFile extends Index implements FileInterface
{
    /**
     * @var string
     */
    private string $url = URL_RETURN;
    /**
     * @var string
     */
    private string $token;
    /**
     * @var Send
     */
    private Send $client;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        $this->client = new Send();
    }


    /**
     * @return bool
     * @throws Exception|GuzzleException
     */
    public function run(): bool
    {
        foreach ($this->list_dirs as $list_dir) {
            $path = $this->path_files . $list_dir;
            $files = scandir($path);
            foreach ($files as $file) {
                if (is_file($path . $file)) {
                    $this->client->post(substr($file, 0, -4),
                        $list_dir, $path . $file, $this->url, $this->token);
                }
            }
        }
        return true;
    }
}
