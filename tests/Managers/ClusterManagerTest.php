<?php

namespace AllrivalSDK\Tests\Managers;

use AllrivalSDK\Exceptions\BadRequestException;
use AllrivalSDK\Managers\ClusterManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\ClusterType;
use PHPUnit\Framework\TestCase;

class ClusterManagerTest extends TestCase
{
    private ClusterManager $clusterManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->clusterManager = new ClusterManager($apiKey);
    }

    /**
     * Проверяем что можно создать и удалить сопоставление
     *
     * @return void
     */
    public function test_create_and_delete_matching_successfully()
    {
        $yourProductId = HelperUtil::getRandomYourProductId();
        $rivalProductId = HelperUtil::getRandomRivalProductId();

        /**
         * @var ClusterType $createdMatching
         */
        $createdMatching = $this->clusterManager->createMatching($yourProductId, $rivalProductId);
        $this->assertTrue($createdMatching instanceof ClusterType);
        $this->assertTrue($createdMatching->isApproved());
        $this->assertTrue(!$createdMatching->isMistake());

        /**
         * @var ClusterType $deletedMatching
         */
        $deletedMatching = $this->clusterManager->deleteMatching($yourProductId, $rivalProductId);
        $this->assertTrue($deletedMatching instanceof ClusterType);
        $this->assertTrue(!$deletedMatching->isApproved());
        $this->assertTrue($deletedMatching->isMistake());

    }

    /**
     * Проверяем что нельзя сопоставить товары с одинаковым id
     *
     * @return void
     */
    public function test_failed_create_matching_with_both_your_products_ids()
    {
        $firstYourProductId = $secondYourProductId = HelperUtil::getRandomYourProductId();
        while ($firstYourProductId !== $secondYourProductId) {
            $secondYourProductId = HelperUtil::getRandomYourProductId();
        }

        $this->expectException(BadRequestException::class);
        $this->clusterManager->createMatching($firstYourProductId, $secondYourProductId);
    }
}