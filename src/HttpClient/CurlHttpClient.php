<?php

namespace AllrivalSDK\HttpClient;

use AllrivalSDK\Exceptions\BadCredentialsException;
use AllrivalSDK\Exceptions\BadRequestException;
use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Exceptions\MethodNotAllowedException;
use AllrivalSDK\Exceptions\NotFoundHttpException;
use RuntimeException;

/**
 * Класс для работы с Curl.php
 */
class CurlHttpClient implements HttpClientInterface
{
    /**
     * @var array
     */
    private array $defaultHeaders = [];

    public function __construct(string $apiKey)
    {
        $this->defaultHeaders = [
            "Content-Type" => "application/json",
            "X-AUTH-TOKEN" => $apiKey,
        ];
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $postData
     * @return array
     * @throws BadCredentialsException
     * @throws BadRequestException
     * @throws MethodNotAllowedException
     * @throws InvalidArgumentException
     * @throws NotFoundHttpException
     */
    public function sendRequest(string $url, string $method = 'GET', array $postData = []): array
    {
        $curl = new Curl($url);

        if ($method !== 'GET') {
            if (empty($postData)) {
                throw new RuntimeException("Call HTTP client with empty post data");
            }

            $curl->setPostData($postData, $method);
        }

        $curl->setHeaders($this->defaultHeaders);

        $data = json_decode($curl->exec(), true);
        $info = $curl->getInfo();

        /**
         * Проверяем, что пришел корректный ответ и только потом передаем данные дальше
         */
        $this->checkResponse(array_merge($data ?? [], $info, ['method' => $method]));

        return $data;
    }

    /**
     * Проверяем ответ. В случае, когда передаются некорректные данные с сервера приходит статус 400 с json'ом,
     * в котором содержится информация, какие данные были переданы неправильно
     *
     * @param array $info
     * @return void
     * @throws BadCredentialsException
     * @throws MethodNotAllowedException
     * @throws BadRequestException|NotFoundHttpException
     */
    private function checkResponse(array $info): void
    {
        $status = $info['http_code'];
        if ($status / 100 === 2) return;

        if ($status / 100 === 5)
            throw new RuntimeException("Something wrong, please try again later");

        if ($status === 401)
            throw new BadCredentialsException("Check API key and retry");

        if ($status === 404)
            throw new NotFoundHttpException("Page not found with url: " . $info['url']);

        if ($status === 405)
            throw new MethodNotAllowedException("Method " . $info['method'] . " not allowed for current endpoint");

        if ($status === 400) {
            $error = '';
            foreach ($info['#'] ?? [] as $idx => $problem) {
                $error = $idx + 1 . ") $problem \n";
            }

            throw new BadRequestException("\n$error.\n Make sure \$yourProductId is your company's product and \$rivalProductId is a rival's company product");
        }
    }
}