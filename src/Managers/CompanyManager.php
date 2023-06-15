<?php

namespace AllrivalSDK\Managers;

use AllrivalSDK\ApiEndpoints;
use AllrivalSDK\Builders\BaseBuilder;
use AllrivalSDK\Builders\CompanyBuilder;
use AllrivalSDK\Exceptions\BadCredentialsException;
use AllrivalSDK\Exceptions\MethodNotAllowedException;

class CompanyManager extends BaseManager
{
    /**
     * @throws MethodNotAllowedException
     * @throws \JsonException
     * @throws BadCredentialsException
     */
    public function getYourCompanyInfo()
    {
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::COMPANY_INFO);

        return $this->returnData($jsonData);
    }

    /**
     * @throws MethodNotAllowedException
     * @throws \JsonException
     * @throws BadCredentialsException
     */
    public function removeProductsByCompanyId($companyId): bool
    {
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::REMOVE_PRODUCTS, 'POST', ['id' => $companyId]);

        return $jsonData['is_deleted'];
    }

    /**
     * @return CompanyBuilder
     */
    protected function getBuilder(): BaseBuilder
    {
        return new CompanyBuilder();
    }
}