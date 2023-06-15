<?php

namespace AllrivalSDK\Types;

class CompanyType implements TypeInterface
{
    private int $id;
    private string $name;
    private string $siteUrl;
    private array $tariff;
    private $parsingFrequency;
    private string $currency;
    private array $rivals;
    private string $parserType;
    private ?array $productListParserSettings;

    private bool $hasProducts;

    /**
     * @return mixed
     */
    public function getParsingFrequency()
    {
        return $this->parsingFrequency;
    }

    /**
     * @param mixed $parsingFrequency
     */
    public function setParsingFrequency($parsingFrequency): void
    {
        $this->parsingFrequency = $parsingFrequency;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * @param string $siteUrl
     */
    public function setSiteUrl(string $siteUrl): self
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * @return array
     */
    public function getTariff(): array
    {
        return $this->tariff;
    }

    /**
     * @param array $tariff
     */
    public function setTariff(array $tariff): self
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getParserType(): string
    {
        return $this->parserType;
    }

    /**
     * @param string $parserType
     */
    public function setParserType(string $parserType): self
    {
        $this->parserType = $parserType;

        return $this;
    }

    /**
     * @return array
     */
    public function getProductListParserSettings(): array
    {
        return $this->productListParserSettings;
    }

    /**
     * @param array $productListParserSettings
     */
    public function setProductListParserSettings(?array $productListParserSettings): self
    {
        $this->productListParserSettings = $productListParserSettings;

        return $this;
    }

    /**
     * @return array
     */
    public function getRivals(): array
    {
        return $this->rivals;
    }

    /**
     * @param array $rivals
     */
    public function setRivals(array $rivals): self
    {
        $this->rivals = $rivals;

        return $this;
    }

    /**
     * @return bool
     */
    public function getHasProducts(): bool
    {
        return $this->hasProducts;
    }

    /**
     * @param bool $hasProducts
     */
    public function setHasProducts(bool $hasProducts): self
    {
        $this->hasProducts = $hasProducts;

        return $this;
    }
}