<?php

namespace AllrivalSDK\Managers;

use AllrivalSDK\Builders\BaseBuilder;
use AllrivalSDK\Builders\BuilderInterface;
use AllrivalSDK\HttpClient\CurlHttpClient;
use AllrivalSDK\HttpClient\HttpClientInterface;

abstract class BaseManager
{
    /**
     * @var HttpClientInterface
     */
    protected HttpClientInterface $httpClient;

    /**
     * Устанавливает, будут ли данные возвращаться в виде объектов или простого массива
     *
     * @var bool
     */
    protected bool $isReturnJson;


    public function __construct(string $apiKey, bool $isReturnJson = false)
    {
        $this->httpClient = new CurlHttpClient($apiKey);
        $this->isReturnJson = $isReturnJson;
    }

    public function setIsReturnArray(bool $isReturnJson): static
    {
        $this->isReturnJson = $isReturnJson;

        return $this;
    }

    /**
     * @param $jsonData
     * @return mixed
     */
    protected function returnData($jsonData)
    {
        if ($this->isReturnJson) {
            return $jsonData;
        }

        return $this->getBuilder()->build($jsonData);
    }

    /**
     * Переопределяется в каждом менеджере, возвращает билдер для конкретного менеджера,
     * билдер наследуется от BaseBuilder
     *
     * @return BaseBuilder
     */
    abstract protected function getBuilder(): BaseBuilder;
}