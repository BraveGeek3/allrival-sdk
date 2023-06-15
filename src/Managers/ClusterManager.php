<?php

namespace AllrivalSDK\Managers;

use AllrivalSDK\ApiEndpoints;
use AllrivalSDK\Builders\BaseBuilder;
use AllrivalSDK\Builders\ClusterBuilder;

class ClusterManager extends BaseManager
{
    public function createMatching(int $yourProductId, int $rivalProductId)
    {
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::CLUSTER, 'POST', [
            'yourProductId' => $yourProductId,
            'rivalProductId' => $rivalProductId,
        ]);

        return $this->returnData($jsonData);
    }

    public function deleteMatching(int $yourProductId, int $rivalProductId)
    {
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::CLUSTER, 'DELETE', [
            'yourProductId' => $yourProductId,
            'rivalProductId' => $rivalProductId,
        ]);

        return $this->returnData($jsonData);
    }

    protected function getBuilder(): BaseBuilder
    {
        return new ClusterBuilder();
    }
}