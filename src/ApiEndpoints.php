<?php

namespace AllrivalSDK;

class ApiEndpoints
{
    public const SITE = 'https://allrival.com';

    //////////////////////////////////
    // Продукты //
    //////////////////////////////////

    /**
     * Методы эндпоинта: POST, DELETE
     * Описание: Позволяет создать и удалить товар по его URL
     * Возвращаемые значения: поля класса ProductType
     */
    public const PRODUCTS = self::SITE . '/api/v1/secured/product';

    /**
     * Методы эндпоинта: GET
     * Описание: Позволяет получить историю цен товара по его ID
     * Возвращаемые значения: массив с историей цен
     *
     * Пример:
     * [
     *  {
     *      "updated_at" => "2023-01-12T14:35:58+03:00",
     *      "price" => "147.00"
     *  },
     *  {
     *      "updated_at" => "2023-01-12T14:37:27+03:00",
     *      "price" => "147.00"
     *  }
     * ]
     */
    public const PRICE_HISTORY = self::SITE . '/api/v1/secured/product/{productId}/price_history/';



    //////////////////////////////////
    // Компания //
    //////////////////////////////////

    /**
     * Методы эндпоинта: GET
     * Описание: получает информацию о компании и её конкурентах
     * Возвращаемые значения: поля класса CompanyType
     */
    public const COMPANY_INFO = self::SITE . '/api/v1/secured/company/company-info';

    /**
     * Методы эндпоинта: POST
     * Описание: удаляет компанию вместе с продуктами
     * Возвращаемые значения: информация об успешном/неуспешном удалении
     *
     * Пример:
     * {
     *     "is_deleted": true
     * }
     */
    public const REMOVE_PRODUCTS = self::SITE . '/api/v1/secured/company/remove-products';



    //////////////////////////////////
    // Сопоставления //
    //////////////////////////////////

    /**
     * Методы эндпоинта: POST, DELETE
     * Описание: создает/удаляет сопоставление товаров по их id
     * Возвращаемые значения: поля класса ClusterType
     */
    public const CLUSTER = self::SITE . '/api/v1/secured/cluster';


    //////////////////////////////////
    // Выгрузки //
    //////////////////////////////////

    /**
     * Методы эндпоинтов: GET
     * Описание: получают выгрузку товаров аналогичную той, что есть в лк
     * и информацию о пагинации (номер страницы, количество товаров на странице,
     * общее количество товаров и т.д.)
     */
    public const YOUR_PRODUCTS = self::SITE . '/api/v1/secured/report/your-products';
    public const RIVAL_PRODUCTS = self::SITE . '/api/v1/secured/report/rival-products';
    public const SIMILAR_PRODUCTS = self::SITE . '/api/v1/secured/report/similars';

}