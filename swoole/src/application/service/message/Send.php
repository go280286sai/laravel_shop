<?php

namespace Root\Parser\application\service\message;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\MultipartStream;

class Send
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     *
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $name
     * @param string $path
     * @param string|false $file
     * @param string|null $url
     * @param string|null $token
     * @return void
     * @throws GuzzleException
     */
    public function post(string $name, string $path, string|false $file = false, string $url = null, string $token = null): void
    {
        if ($file) {
            $multipart = new MultipartStream([
                [
                    'name' => 'name',
                    'contents' => $name
                ],
                [
                    'name' => 'path',
                    'contents' => $path
                ],
                [
                    'name' => 'file',
                    'contents' => fopen($file, 'r'), // Open the file as a stream
                    'filename' => basename($file) // Specify the filename
                ]
            ]);

            try {
                $this->client->request('POST', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'multipart/form-data; boundary=' . $multipart->getBoundary(),
                    ],
                    'body' => $multipart
                ]);
            } catch (ClientException $e) {
                // Handle client errors (e.g., 400 Bad Request)
                echo 'Error: ' . $e->getResponse()->getBody()->getContents();
            }
        } else {
            try {
              $send =  $this->client->post($url,  ['form_params' =>[
                        'name' => $name,
                        'path' => $path,
                        'file' => ""
                    ], 'headers' => ['Authorization' => 'Bearer ' . $token]]
                );
            } catch (Exception $e){
                echo $e->getMessage();
            }
                    }
    }
}