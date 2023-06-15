<?php

namespace AllrivalSDK\HttpClient;

interface HttpClientInterface
{
    /**
     * @param string $url
     * @param string $method
     * @param array $postData
     * @return array
     */
    public function sendRequest(string $url, string $method = 'GET', array $postData = []): array;
}