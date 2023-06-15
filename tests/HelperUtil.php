<?php

namespace AllrivalSDK\Tests;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use Symfony\Component\Dotenv\Dotenv;

class HelperUtil
{
    public const TEST_URLS = [
        'https://www.ozon.ru' => [
            'https://www.ozon.ru/product/komplekt-rezinok-dlya-volos-80-sht-295252086/?asb=VcDKjuqxTDlzYDsIQJuPQFeWOBU50TAaHGy0PugsdfA%253D&asb2=1nmIeGFMAoFgHPyfNwevnxpZvNxeHW7jn06UKNu_5EPXkqhqbrtwcszhTl4Bizcy&avtc=1&avte=2&avts=1682606080&keywords=%D1%81%D0%B8%D0%BB%D0%B8%D0%BA%D0%BE%D0%BD%D0%BE%D0%B2%D1%8B%D0%B5+%D1%80%D0%B5%D0%B7%D0%B8%D0%BD%D0%BA%D0%B8+%D0%B4%D0%BB%D1%8F+%D0%B2%D0%BE%D0%BB%D0%BE%D1%81&sh=A5xbb7j2EA',
            'https://www.ozon.ru/product/silikonovye-rezinki-dlya-volos-prozrachnye-detskie-rezinki-v-udobnoy-banochke-dlya-hraneniya-100-sht-666095118/?asb=GCFxXbavtz7V5e020EiChbMAhsfkuJv4%252B9nCs3yx%252B3yWDhfx7r0AXE5zZl7MWbQC&asb2=hgkG9tEyWnoIdVfEOzKqIhC5UBqk3F7auW8_FdkkGY_Xz5oIEybNYEXj6c2pWGU3j-YKWcMz9LKEO7DtTqDbIrROVoYhPn88tmrhD-Ek0VMlJo7bWQLt6iqA9Sq5XjeYt6eanwiT4o1N9B0NA9aYSzI0ortVVRFXTtZtNVdfl5g&avtc=1&avte=2&avts=1682606147&keywords=%D1%81%D0%B8%D0%BB%D0%B8%D0%BA%D0%BE%D0%BD%D0%BE%D0%B2%D1%8B%D0%B5+%D1%80%D0%B5%D0%B7%D0%B8%D0%BD%D0%BA%D0%B8+%D0%B4%D0%BB%D1%8F+%D0%B2%D0%BE%D0%BB%D0%BE%D1%81&sh=A5xbbxk9tA',
            'https://www.ozon.ru/product/silikonovye-rezinki-dlya-volos-allissi-prozrachnye-nabor-250-shtuk-malenkie-rezinki-dlya-647101642/?asb=PPMNqUFutUmyLrC4xH%252BdOmrWSns8%252BU7sGwzjwuyPFuWPmfBH6bkBI27LUlVYndtS&asb2=ZbHe2AknMR_pF9AOtnTa2n9xdu-XvZkQsEt1ZSBAdShmO1ZLr7nwSkCsr5vNUqhghilvVoVWEgLPsclE0woGTErqd4T4mPEBHJRbPrWROK1L9H1uHaYj_qdm270D0H-oPdCyXg7d_fxBoabkAAM6KKFhRFbIOK2lRalzabJCb_A&avtc=1&avte=2&avts=1682606345&from_sku=647391316&from_url=https%253A%252F%252Fwww.ozon.ru%252Fcategory%252Faksessuary-7697%252F%253Fcategory_was_predicted%253Dtrue%2526deny_category_prediction%253Dtrue%2526from_global%253Dtrue%2526text%253D%2525D1%252581%2525D0%2525B8%2525D0%2525BB%2525D0%2525B8%2525D0%2525BA%2525D0%2525BE%2525D0%2525BD%2525D0%2525BE%2525D0%2525B2%2525D1%25258B%2525D0%2525B5%252B%2525D1%252580%2525D0%2525B5%2525D0%2525B7%2525D0%2525B8%2525D0%2525BD%2525D0%2525BA%2525D0%2525B8%252B%2525D0%2525B4%2525D0%2525BB%2525D1%25258F%252B%2525D0%2525B2%2525D0%2525BE%2525D0%2525BB%2525D0%2525BE%2525D1%252581&keywords=%D1%81%D0%B8%D0%BB%D0%B8%D0%BA%D0%BE%D0%BD%D0%BE%D0%B2%D1%8B%D0%B5+%D1%80%D0%B5%D0%B7%D0%B8%D0%BD%D0%BA%D0%B8+%D0%B4%D0%BB%D1%8F+%D0%B2%D0%BE%D0%BB%D0%BE%D1%81&oos_search=false&sh=A5xbb9Kp5w',
            'https://www.ozon.ru/product/komplekt-rezinok-dlya-volos-eas-170-sht-389241197/?asb=9Vv6kGoLw%252BMqsWXe0AYhVO9WlvW53oddLZLxTnUTmHx1Y6siFqd2nvNgj273%252F6zq&asb2=8WYo0AjOSmChnk1wu42hOAU4QjsbdVAS7SAxDv1ARvknawkvW5q4yCQ1TgrNa80PKW1VtxG8geZM6h_E7P7y6cbH2jJkcnCByVDGs9CM_--x-rnuj8QpwEw6WQfqSFltdFhd6U-CXYxNRbd0KXzctw&avtc=1&avte=2&avts=1682606392&keywords=%D1%81%D0%B8%D0%BB%D0%B8%D0%BA%D0%BE%D0%BD%D0%BE%D0%B2%D1%8B%D0%B5+%D1%80%D0%B5%D0%B7%D0%B8%D0%BD%D0%BA%D0%B8+%D0%B4%D0%BB%D1%8F+%D0%B2%D0%BE%D0%BB%D0%BE%D1%81&sh=A5xbb5FvdA',
        ],
        'https://www.wildberries.ru' => [
            'https://www.wildberries.ru/catalog/46369147/detail.aspx',
            'https://www.wildberries.ru/catalog/71835944/detail.aspx',
            'https://www.wildberries.ru/catalog/113203235/detail.aspx',
            'https://www.wildberries.ru/catalog/104698055/detail.aspx',
            'https://www.wildberries.ru/catalog/104698677/detail.aspx',
            'https://www.wildberries.ru/catalog/114503086/detail.aspx',
            'https://www.wildberries.ru/catalog/147714241/detail.aspx',
            'https://www.wildberries.ru/catalog/122034070/detail.aspx',
        ],
        'https://www.vseinstrumenti.ru' => [
            'https://www.vseinstrumenti.ru/product/invertornyj-apparat-poluavtomaticheskoj-svarki-quattro-elementi-digi-mig-195-772-609-718595/',
            'https://www.vseinstrumenti.ru/product/porshnevoj-bezmaslyanyj-kompressor-quattro-elementi-km-0-150-919-860-985771/',
            'https://www.vseinstrumenti.ru/product/invertornyj-apparat-poluavtomaticheskoj-svarki-quattro-elementi-digi-mig-235-772-616-718607/',
            'https://www.vseinstrumenti.ru/product/porshnevoj-bezmaslyanyj-kompressor-quattro-elementi-pacific-24-911-475-886034/',
            'https://www.vseinstrumenti.ru/product/apparat-poluavtomaticheskoj-svarki-invertor-multi-pro-1700-165a-quattro-elementi-790-052-989333/',
            'https://www.vseinstrumenti.ru/product/invertornyj-apparat-poluavtomaticheskoj-svarki-quattro-elementi-multi-pro-2100-772-593-718616/',
        ],
    ];

    public const TEST_IDS = [
        'your' => [
            2809395539,
            2815238205,
            2892552816,
            2892552817,
        ],
        'rival' => [
            2892551660,
            2892552306,
            2892552711,
            2892552813,
            2892552814,
            2892552815,
            3704857320,
        ],
    ];

    public static function extractApiKey(): string
    {
        $dotenv = new Dotenv();
        $rootDir = dirname(__FILE__, 2);
        $dotenv->load($rootDir .'/.env', $rootDir .'/.env.local');

        $apiKey = $_ENV['ALLRIVAL_API_KEY'] ?? $_SERVER['ALLRIVAL_API_KEY'] ?? null;
        if (!$apiKey)
            throw new InvalidArgumentException("Неверный ключ api");

        return $apiKey;
    }

    public static function getRandomProductUrl(string $siteName = null): string
    {
        if (!isset($siteName))
            $siteName = array_rand(self::TEST_URLS);

        return self::TEST_URLS[$siteName][array_rand(self::TEST_URLS[$siteName])];
    }

    public static function getRandomRivalProductId(): int
    {
        return self::TEST_IDS['rival'][array_rand(self::TEST_IDS['rival'])];
    }

    public static function getRandomYourProductId(): int
    {
        return self::TEST_IDS['your'][array_rand(self::TEST_IDS['your'])];
    }
}