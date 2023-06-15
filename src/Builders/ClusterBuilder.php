<?php

namespace AllrivalSDK\Builders;

use AllrivalSDK\Types\ClusterType;

class ClusterBuilder extends BaseBuilder
{
    /**
     * @var ClusterType
     */
    private ClusterType $cluster;

    /**
     * @param array $data
     * @return ClusterType
     */
    public function build(array $data): ClusterType
    {
        $this->cluster
            ->setId($data['id'])
            ->setCreatedAt($data['createdAt'])
            ->setUpdatedAt($data['updatedAt'])
            ->setApproved($data['approved'])
            ->setMistake($data['mistake'])
            ->setHighlitedName($data['highlighted_name'] ?? '')
            ->setRivalProductId($data['rivalProductId'])
            ->setYourProductId($data['yourProductId'])
        ;

        $result = $this->cluster;
        $this->reset();

        return $result;
    }

    /**
     * @return void
     */
    protected function reset(): void
    {
        $this->cluster = new ClusterType();
    }
}