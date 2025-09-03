<?php
namespace App\Services;

use GuzzleHttp\Client;

class VimeoService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.vimeo.com/',
            'headers' => [
                'Authorization' => 'Bearer ' . config('vimeo.access_token'),
                'Accept' => 'application/vnd.vimeo.*+json;version=3.4',
            ],
        ]);
    }

    public function uploadVideo($videoPath)
    {
        $response = $this->client->post('me/videos', [
            'multipart' => [
                [
                    'name' => 'upload',
                    'contents' => fopen($videoPath, 'r'),
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
