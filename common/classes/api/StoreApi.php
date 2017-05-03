<?php
/**
 * User: alexey.koptelov
 * Date: 25.11.13
 * Time: 12:40
 */

class StoreApi extends CApplicationComponent {
    public $url;
    const STORE_INTERNET = 1;
    const STORE_KOMENDANTSKI = 2;

    const ACCOUNT_AVANGARD = 1;
    const ACCOUNT_ROBOKASSA = 2;
    const ACCOUNT_STORE_KOMENDANTSKI = 3;
    const ACCOUNT_COURIER = 4;
    const ACCOUNT_HOME = 5;
    const ACCOUNT_YANDEX = 6;

    public static $payment_to_account = array(
        1 => self::ACCOUNT_COURIER, // Наличными курьеру
        2 => self::ACCOUNT_ROBOKASSA, // ЭД (Robokassa)
        3 => self::ACCOUNT_STORE_KOMENDANTSKI, // Оплата при получении
        4 => self::ACCOUNT_AVANGARD, // Visa, MasterCard (Avangard)
        5 => self::ACCOUNT_AVANGARD, // По счету
        6 => self::ACCOUNT_ROBOKASSA, // Visa, MasterCard (Robokassa)
        7 => self::ACCOUNT_ROBOKASSA, // Терминал (Robobkassa)
        8 => self::ACCOUNT_ROBOKASSA, // Связной (Robobkassa)
        9 => self::ACCOUNT_YANDEX, // Visa, MasterCard (Yandex)
        10 => self::ACCOUNT_YANDEX, // Альфа-Клик (Yandex)
        11 => self::ACCOUNT_YANDEX, // Наличные через терминал (Yandex)
        12 => self::ACCOUNT_YANDEX, // QIWI кошелек (Yandex)
        13 => self::ACCOUNT_YANDEX, // Мобильная коммерция (Yandex)
        14 => self::ACCOUNT_YANDEX, // Интернет-банк Промсвязьбанка (Yandex)
        15 => self::ACCOUNT_YANDEX, // Кошелек Яндекс.Денег (Yandex)
        16 => self::ACCOUNT_YANDEX, // Сбербанк Онлайн (Yandex)
        17 => self::ACCOUNT_YANDEX, // Кошелек WebMoney (Yandex)
    );

    public static $payment_to_account_store = array(
        1 => self::ACCOUNT_STORE_KOMENDANTSKI, // Наличными
        2 => self::ACCOUNT_AVANGARD, // Банковской картой)
    );


    public function sale($products) {
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => http_build_query($products),
            ),
        ));

        $response = file_get_contents($this->url, false, $context);
        return $response;
    }
}