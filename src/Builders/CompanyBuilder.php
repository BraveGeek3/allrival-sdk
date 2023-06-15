<?php

namespace AllrivalSDK\Builders;

use AllrivalSDK\Types\CompanyType;

class CompanyBuilder extends BaseBuilder
{
    /**
     * @var CompanyType
     */
    private CompanyType $company;

    /**
     * @var array
     */
    private array $hasProducts;

    /**
     * @param array $data
     * @return CompanyType
     */
    public function build(array $data): CompanyType
    {
        $this->hasProducts = $data['has_products'];

        $this->company = $this
            ->setMainFields($data['company_info'])
            ->setTariff($data['company_info']['tariff'])
        ;

        $result = $this->company;
        $this->reset();

        return $result;

    }

    /**
     * @return void
     */
    protected function reset(): void
    {
        $this->company = new CompanyType();
        $this->hasProducts = [];
    }

    /**
     * @param array $companyInfo
     * @return CompanyType
     */
    private function setMainFields(array $companyInfo): CompanyType
    {
        $company = new CompanyType();
        $company
            ->setId($companyInfo['id'])
            ->setName($companyInfo['name'])
            ->setSiteUrl($companyInfo['site_url'])
            ->setCurrency($companyInfo['currency'])
            ->setParserType($companyInfo['parser_type'])
            ->setProductListParserSettings($companyInfo['product_list_parser_settings'] ?? null)
            ->setHasProducts($this->hasProducts[$companyInfo['name']])
            ->setParsingFrequency($companyInfo['parsing_frequency'])
        ;

        $rivals = [];
        foreach ($companyInfo['rivals'] as $rival) {
            $rivals[] = $this->setMainFields($rival);
        }
        $company->setRivals($rivals);

        return $company;
    }
}