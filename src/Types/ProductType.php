<?php

namespace AllrivalSDK\Types;

use AllrivalSDK\Tools\Converter;
use DateTime;

class ProductType implements TypeInterface
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var DateTime
     */
    private DateTime $createdAt;

    /**
     * @var DateTime
     */
    private DateTime $updatedAt;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var array
     */
    private array $rivalsProducts = [];
    /**
     * @var array
     */
    private array $attributes = [];

    /**
     * @var array
     */
    private array $tags = [];

    /**
     * @var string
     */
    private string $city;

    /**
     * @var string
     */
    private string $company;

    /**
     * @var string
     */
    private string $category;

    /**
     * @var
     */
    private $externalId;

    /**
     * @var string
     */
    private string $imgUrl;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var float|null
     */
    private $costPrice;

    /**
     * @var float
     */
    private $price;

    /**
     * @var int|null
     */
    private $recommendedPrice;

    /**
     * @var string
     */
    private string $manufacturer;

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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = Converter::convertStrToDt($createdAt);

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = Converter::convertStrToDt($updatedAt);

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
     * @return array
     */
    public function getRivalsProducts(): array
    {
        return $this->rivalsProducts;
    }

    /**
     * @param array $products
     * @return $this
     */
    public function setRivalsProducts(array $products): self
    {
        $this->rivalsProducts = $products;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param $tags
     * @return $this
     */
    public function setTags($tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return $this
     */
    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return int
     */
    public function getExternalId(): int
    {
        return $this->externalId;
    }

    /**
     * @param $externalId
     * @return $this
     */
    public function setExternalId($externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * @return string
     */
    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    /**
     * @param string $imgUrl
     */
    public function setImgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return int
     */
    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /**
     * @param int|null $costPrice
     * @return $this
     */
    public function setCostPrice(?int $costPrice): self
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int
     */
    public function getRecommendedPrice(): int
    {
        return $this->recommendedPrice;
    }


    /**
     * @param int|null $recommendedPrice
     * @return $this
     */
    public function setRecommendedPrice(?int $recommendedPrice): self
    {
        $this->recommendedPrice = $recommendedPrice;

        return $this;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

}