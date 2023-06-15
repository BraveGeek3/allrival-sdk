<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\OnlyExplicitValuesFilter;

/**
 * Указываются значения, по которым можно производить сортировку
 */
class SortByFilter extends OnlyExplicitValuesFilter
{
    // Изображение
    public const IMAGE = 'imgUrl';

    // Название
    public const NAME= 'name';

    // Розничная
    public const PRICE = 'price';

    // Себестоимость
    public const COST_PRICE = 'costPrice';

    // Рекомендуемая
    public const RECOMMENDED_PRICE = 'recommendedPrice';

    // URL
    public const URL = 'url';

    // Производитель
    public const MANUFACTURER = 'manufacturer';

    // Атрибуты
    public const ATTRIBUTES = 'attributes';

    // ID
    public const ID = 'id';

    // Внешний ID
    public const EXTERNAL_ID = 'externalId';

    // Создано
    public const CREATED_AT = 'createdAt';

    // Обновлено
    public const UPDATED_AT = 'updatedAt';

    public function getStringQuery(): string
    {
        return "filter[" . $this->getName() . "]=" . $this->value;
    }

    protected string $name = '_sort_by';
}