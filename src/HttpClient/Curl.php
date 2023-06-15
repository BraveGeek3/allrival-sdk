<?php
namespace AllrivalSDK\HttpClient;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use RuntimeException;

/*
 * Обертка над библиотекой libcurl
 */
class Curl
{
    /**
     * @var \CurlHandle
     */
    private $curl;

    public function __construct(?string $url = null)
    {
        $this->init($url);
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @param string|null $url
     * @return void
     */
    public function init(?string $url): void
    {
        if ($this->curl === null) {
            $this->curl = curl_init($url);
        }

        curl_setopt($this->curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @return bool|string
     */
    public function exec(): bool|string
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        return curl_exec($this->curl);
    }

    /**
     * @param $option
     * @param $value
     * @return bool
     */
    public function setOption($option, $value): bool
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        return curl_setopt($this->curl, $option, $value);
    }

    /**
     * @param array $options
     * @return bool
     */
    public function setOptionsArray(array $options): bool
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        return curl_setopt_array($this->curl, $options);
    }

    /**
     * @return mixed
     */
    public function getInfo(): mixed
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        return curl_getinfo($this->curl);
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        return curl_error($this->curl);
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        return curl_errno($this->curl);
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        curl_close($this->curl);

        $this->curl = null;

        return true;
    }

    /**
     * @param array $postData
     * @param string $method
     * @return bool
     * @throws InvalidArgumentException
     */
    public function setPostData(array $postData, string $method): bool
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        /**
         * На всякий случай ловим исключения из-за неправильных данных
         */
        try {
            $postData = json_encode($postData, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $this->close();
            throw new InvalidArgumentException($e->getMessage());
        }

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postData);

        return true;
    }

    /**
     * @param array $headers
     * @return bool
     */
    public function setHeaders(array $headers): bool
    {
        if (!isset($this->curl)) {
            throw new RuntimeException('You must call init first');
        }

        $readableHeaders = [];
        foreach ($headers as $key => $value) {
            $readableHeaders[] = "$key: $value";
        }

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $readableHeaders);

        return true;
    }
}