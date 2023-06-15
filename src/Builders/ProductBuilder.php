<?php

namespace AllrivalSDK\Builders;

use AllrivalSDK\Types\ProductType;

class ProductBuilder extends BaseBuilder
{
    private ProductType $product;

    public function build(array $data): ProductType
    {
        $this->product = $this->setMainFields($data);

        $rivalsProducts = [];
        foreach ($data['rivalsAllMatches'] ?? [] as $rivalCompany => $products) {
            foreach ($products as $product) {
                $rivalsProducts[$rivalCompany][] = $this->setMainFields($product);
            }
        }

        $this->product->setRivalsProducts($rivalsProducts);

        $result = $this->product;
        $this->reset();

        return $result;
    }

    protected function reset(): void
    {
        $this->product = new ProductType();
    }

    private function setMainFields(array $data): ProductType
    {
        return (new ProductType())
            ->setId($data['id'])
            ->setCreatedAt($data['created_at'])
            ->setUpdatedAt($data['updated_at'])
            ->setName($data['name'])
            ->setAttributes($data['attributes'])
            ->setTags($data['tags'])
            ->setCity($data['city'])
            ->setCompany($data['company'])
            ->setCategory($data['category'])
            ->setExternalId($data['external_id'])
            ->setImgUrl($data['img_url'] ?? '')
            ->setUrl($data['url'])
            ->setCostPrice($data['cost_price'] ?? null)
            ->setPrice($data['price'])
            ->setRecommendedPrice($data['recommended_price'] ?? null)
            ->setManufacturer($data['manufacturer'] ?? '')
        ;
    }
}