# Allrival-SDK
An SDK designed for easy usage of the allrival.com website's API

SKD созданное для упрощенного взаимодействия с API сайта allrival.com  
[Документация к API](https://allrival.com/docs-api)

## Установка
```
composer require bravegeek/allrival-sdk
```
[Ссылка на Packagist](https://packagist.org/packages/bravegeek/allrival-sdk)
## Клиент
Класс AllrivalSDK\Client.php является точкой входа для взаимодействия с SDK. <br>
В нем находятся менеджеры, через которых идет взаимодействие с API Allrival.
## Менеджеры
В данном SDK представлены 5 типов менеджеров:
<ul>
<li>Product Manager</li>
<li>Company Manager</li>
<li>Cluster Manager</li>
<li>Report Manager</li>
<li>Price history Manager</li>
</ul>


1) Product Manager отвечает за добавление и удаление товаров. При передачи url
уже сохраненного товара сервер вернет полную информацию о нем.<br>
Методы:
<ul>
<li>addProduct<br>
Принимает Url товара, который вы хотите сохранить. Возвращает информацию о сохраненном товаре<br>
Примеры:

```
// URL товара
$productUrl = 'https://www.wildberries.ru/catalog/46369147/detail.aspx';

// Возвращает ProductType / array
$createdProduct = $this->productManager->addProduct($productUrl);
```
</li>
<li>deleteProduct<br>
Принимает Url товара, который вы хотите удалить. Возвращает булево значение о результате удаления (true/false)<br>

```
// Возвращает true / false
$result = $this->productManager->deleteProduct($productUrl);
```
</li>
</ul>

2) Company Manager отвечает за получение всей информации о компании и её конкурентах на сайте Allrival а также удаление компании вместе с продуктами по её ID<br>
Методы:
<ul>
<li>getYourCompanyInfo <br>
Возвращает информацию о вашей компании и её конкурентах <br>
Примеры:

```
// Возвращает CompanyType / array
$result = $this->companyManager->getYourCompanyInfo();
```
</li>
<li>removeProductsByCompanyId <br>
Удаляет компанию вместе с продуктами по её ID <br>

```
$id = ...; // Id вашей компании

// Возвращает true / false
$result = $this->companyManager->removeProductsByCompanyId($id)
```
</li>
</ul>

3) Cluster Manager отвечает за создание/удаление сопоставлений по ID Вашего продукта и ID продукта конкурента. <br>
Если будут переданы неправильные ID продуктов (оба ID вашей компании, оба ID компании конкурента) менеджер выкинет BadRequestException с информацией о неправильных ID.
Методы:
<ul>
<li>createMatching <br>
Принимает параметры ID продукта вашей компании и ID продукта компании конкурента. <br>
В случае успеха, возвращает о созданном сопоставлении.<br>

```
$yourProductId = ...; // Id продукта вашей компании
$rivalProductId = ...; // Id продукта компании конкурента

// Возвращает ClusterType / array
$createdMatching = $this->clusterManager->createMatching($yourProductId, $rivalProductId);
```
</li>
<li>deleteMatching <br>
Принимает параметры ID продукта вашей компании и ID продукта компании конкурента.<br>
В случае успеха, возвращает об удаленном сопоставлении.<br>

```
$yourProductId = ...; // Id продукта вашей компании
$rivalProductId = ...; // Id продукта компании конкурента

// Возвращает ClusterType / array
$deletedMatching = $this->clusterManager->deleteMatching($yourProductId, $rivalProductId);
```
</li>
</ul>
4) Report Manager - отвечает за выгрузку. Принимает фильтры, которые будут использованы при выборке. <br>
Методы:
<ul>
<li>getYourProducts <br>
Принимает произвольное количество фильтров и возвращает выгрузку ваших продуктов на основе фильтров.

```
// $filters - массив фильтров для выгрузки
// Возвращает ReportType содержащий массив продуктов и информацию о пагинации
$result = $this->reportManager->getYourProducts(...$filters);
```
</li>
<li>getRivalProducts <br>
Принимает произвольное количество фильтров и возвращает выгрузку продуктов конкурентов на основе фильтров.

```
// $filters - массив фильтров для выгрузки
// Возвращает ReportType содержащий массив продуктов и информацию о пагинации
$result = $this->reportManager->getRivalProducts(...$filters);
```
</li>
<li>getSimilars <br>
Принимает произвольное количество фильтров и возвращает выгрузку сопоставлений ваших товаров с товарами конкурентов на основе фильтров.

```
// $filters - массив фильтров для выгрузки
// Возвращает ReportType содержащий массив ваших товаров и массив совпавших товаров конкурентов и информацию о пагинации
$result = $this->reportManager->getSimilars(...$filters);
```
</li>
<li>setFilters <br>
Сохраняет переданные фильтры для использования в последующих запросах

```
// $filters - массив фильтров для выгрузки
$this->reportManager->setFilters(...$filters);
```
</li>
<li>addFilter <br>
Добавляет переданный фильтр к массиву уже сохраненных фильтров

```
// $filter - фильтр для выгрузки
$this->reportManager->setFilters($filter);
```
</li>
<li>removeFilter <br>
Удаляет переданный фильтр из массива уже сохраненных фильтров по его названию

```
// $filter - фильтр для выгрузки
// Может быть как строкой так и FilterInterface
$this->reportManager->removeFilter($filter);
```
</li>
<li>replaceFilter <br>
Заменяет существующий сохраненный фильтр переданным

```
// $filter - фильтр для выгрузки (FilterInterface)
$this->reportManager->replaceFilter($filter);
```
</li>
<li>resetFilters <br>
Очищает сохраненные фильтры, добавленные через setFilters()

```
$this->reportManager->resetFilters();
```
</li>
</ul>


## Фильтры
Каждый фильтр наследуется от соответствующего типа фильтра. 
Существует 8 видов фильтров:
1) BooleanFilter - Фильтр для булевых типов фильтров (где есть выбор да/нет)
2) EmptyTypeFilter - Без указания типа фильтра, принимает только явные значения
3) EmptyTypeMultipleValuesFilter - Для фильтров с выбором нескольких значений (тэги, города, категории и т.д.) и без типа фильтра
4) InequalityFilter - Фильтр для сравнения числовых значений
5) MembershipFilter - Фильтр для строковых значений. Позволяет указать принадлежит ли одна строка другой или сравнить их
6) MultipleValuesFilter - Для типов фильтров с выбором нескольких значений (города, категории и компании) с выбором типа фильтра
7) OnlyExplicitValuesFilter - Фильтр без указания типа, принимает только явные значения. Примеры параметров можно посмотреть в личном кабинете allrival.com
8) TimePeriodFilter - Фильтр для работы с датой и временем

## Примеры
<ul>
<li>
Получение ваших товаров на основе фильтров

```
// $apiKey - API ключ из личного кабинета Allrival
$apiKey = ...;

// Создаем клиент
$client = new Client($apiKey);

// Создаем массив нужных фильтров
$filters = [
    new PriceFilter(50, PriceFilter::GREATER_THAN),
    new NameFilter('Товар', NameFilter::CONTAINS),
    new SimilarProductPriceFilter(50, SimilarProductPriceFilter::GREATER_THAN),
    new WithBestPriceFilter(WithBestPriceFilter::YES),
    new RivalsCompanyFilter(111),
];

// Добавляем фильтры в клиент для последующих запросов
$client->setFilters(...$filters);


/**
 * Получаем выгрузку ваших продуктов с фильтрами
 *
 * @var $report ReportType
 */
$report = $this->reportManager->getYourProducts();

// Массив с вашими продуктами
$products = $report->getItems();

// Информация о пагинации
$pagination = $report->getPagination();

// Количество ваших продуктов на странице
$itemsCount = $pagination->getItemsCount();

// Общее количество ваших продуктов
$itemsTotalCount = $pagination->getItemsTotalCount();

// Общее количество страниц
$pagesCount = $pagination->getPagesCount();

// Делаем что-нибудь с продуктами
// ...
```
</li>
<li>
Добавление и удаление товаров

```
// $apiKey - API ключ из личного кабинета Allrival
$apiKey = ...;

// Создаем клиент
$client = new Client($apiKey);

// Ссылка на товар
$createdProductUrl = ...;

// Получаем добавленный продукт в виде ProductType
$createdProduct = $this->productManager->addProduct($createdProductUrl);

// Делаем что-то с добавленным товаром
...
....
.....

// URL удаляемого товара
$deletedProductUrl = ...;

// Информация об удалении товара (true/false)
$isDeleted = $this->productManager->deleteProduct($deletedProductUrl);
```
</li>
<li>
Получение истории цен

```
// Id продукта, у которого хотим получить историю цен
$productId = ...;

/**
 * @var PriceHistoryType $priceHistory
 */
$priceHistory = $this->priceHistoryManager->getPriceHistory($productId);

// Может быть UNIX-time, строкой или DateTime
$date = ...;

// Получаем цену в указанный момент времени
$price = $priceHistory->getByDate($date);

// Возвращает массив с историей цен
$priceHistoryArray = $priceHistory->getHistory();
```
</li>
<li>
Создание и удаление сопоставлений

```
// Id продукта из вашей компании
$yourProductIdForCreatedMatch = ...;

// Id продукта из компании конкурента
$rivalProductIdForCreatedMatch = ...;

/**
 * @var ClusterType $createdMatching
 */
$createdMatching = $this->clusterManager->createMatching($yourProductIdForCreatedMatch, $rivalProductIdForCreatedMatch);

...
....
.....

// Id продукта из вашей компании
$yourProductIdForDeletedMatch = ...;

// Id продукта из компании конкурента
$rivalProductIdForDeletedMatch = ...;

/**
 * @var ClusterType $deletedMatching
 */
$deletedMatching = $this->clusterManager->deleteMatching($yourProductIdForDeletedMatch, $rivalProductIdForDeletedMatch);
```
</li>
</ul>

Больше примеров использования находятся в папке ./tests
