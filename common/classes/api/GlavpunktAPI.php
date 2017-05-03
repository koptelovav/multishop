<?php

/**
 * GlavpunktAPI 
 *
 * 1. take_pkgs передача информации в систему Glavpukt.ru по передаваемым заказам
 * 2. punkts перечень пунктов выдачи Glavpunkt.ru
 * 3. pkg_status статус заказа или нескольких заказов
 *
 * @version 22.05.2015
 */
class GlavpunktAPI extends CApplicationComponent{

  public $login;
  public $token;
  public $host = 'glavpunkt.ru';
  
  /**
   * Передача в систему Glavpunkt.ru данных о передаваемых заказах (электронная накладная)
   *
   * Пример отправляемых данных (2 заказа в одной накладной):
   * $nakl = array( 
   *   'comments_client' => 'comment к накл', //комментарий к накладной
   *   'punkt_id' => ''
   *   'orders' => array(
   *     // Заказ ТEST-1 стоимостью 123р
   *     array(
   *       'sku' => 'ТEST-1', //номер заказа (обязательное поле)
   *       'price' => 123, //сумма к оплате клиентом (обязательное поле)
   *       'buyer_phone' => '123-34-45', //тел. клиента
   *       'buyer_fio'   => 'Владимир Петров', //имя клиента
   *       'comment'     => 'comment1' //коммент к заказу
   *       'dst_punkt_id' => 'Moskovskaya-A16' // если нужно перемещение, то в этом поле
   *                                           // указывается пункт куда нужно переместить заказ
   *     ),
   *     // Заказ TEST-2 на доставку
   *     array(
   *       'sku' => 'ТEST-2',
   *       'price' => 1234,
   *       'payed' => 1, //признак, что заказ предоплачен 
   *       'buyer_phone' => '123-56-89',      
   *       'buyer_delivery_needed' => 1, // нужна доставка
   *       'delivery_cost' => 200, // тариф (см. http://glavpunkt.ru/delivery.html) NEW 22.05.2015
   *       'delivery_payby' => 'ИМ', // за чей счет доставка: NEW 22.05.2015
   *                                 //   'ИМ' - интернет-магазин, 
   *                                 //   'покупатель' за счет покупателя
   *       'buyer_address' => 'адрес', // адрес доставки
   *       'buyer_delivery_time' => 'пожелания к дате/времени доставки', // пожелания к дате/времени доставки
   *       'comment'     => 'comment1' //коммент к заказу
   *     ),    
   *   )
   * );
   *
   *
   * Ответ в JSON:
   * если заказы сохранены:
   * { 
   *   "result" : "ok",
   *   "docnum" : 2123 // номер накладной
   * }
   * 
   * если произошла ошибка:
   * {
   *   "result"  : "error",
   *   "message" : "сообщение об ошибке"
   * }
   */
  public function registerOrder($orders) {

    $data = array(
        'login' =>  $this->login,
        'token' => $this->token,
        'punkt_id' => 'Komendantskiy-K9k1',
        'orders' => array()
    );
    foreach($orders as $key=>$order){
      $customer = $order->customer;
      $customerAddress = $customer->address;

      $payed = $order->payment_status == 2 ? 1 : 0;
      $price = $payed ? ($order->total - $order->total*0.4) : $order->total;

      $data['orders'][] = array(
          'sku' => $order->id, //номер заказа (обязательное поле)
          'price' => $price, //сумма к оплате клиентом (обязательное поле)
          'buyer_fio'   => $customer->name, //имя клиента
          'buyer_phone' => $customer->phone, //тел. клиента
          'payed' => $payed,
          'comment' => $order->comment
      );

      $data['orders'][$key]['delivery_cost'] = 385;
      $data['orders'][$key]['delivery_payby'] = 'ИМ';
      $data['orders'][$key]['buyer_address'] =  $customerAddress->getFullCityAddress();
      $data['orders'][$key]['buyer_delivery_time'] =  $order->getAdditionalFieldByName('shipping_date')->value.', '.$order->getAdditionalFieldByName('shipping_time')->value;

      switch($order->shipping_id){
        case Shipping::GLAVPUNKT_SPB:
          if($customerAddress->pvz != 'Komendantskiy-K9k1')
            $data['orders'][$key]['dst_punkt_id'] = $customerAddress->pvz;
          $data['orders'][$key]['delivery_naspunkt'] = 'По Петербургу';
          break;

        case Shipping::GLAVPUNKT_SPB_COURIER:
        case Shipping::GLAVPUNKT_SPB_COURIER_LO:
          $data['orders'][$key]['buyer_delivery_needed'] = 1;
          $data['orders'][$key]['delivery_naspunkt'] = 'По Петербургу';
          break;

        case Shipping::GLAVPUNKT_MSK:
          $data['orders'][$key]['buyer_delivery_needed'] = 1;
          $data['orders'][$key]['delivery_naspunkt'] = 'По Москве';
          break;

        case Shipping::GLAVPUNKT_MSK_STORE:
          $data['orders'][$key]['dst_punkt_id'] = $customerAddress->pvz;
          $data['orders'][$key]['delivery_naspunkt'] = 'По Москве';
          break;
      }
    }
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    $res = $this->post('/api/take_pkgs', $data);

    return $res; //ответ
  }

  /**
   * Возвращает статус заказа или нескольких заказов
   * 
   * Возможные статусы заказов:
   *   not found       - информация о заказе отсутствует в системе
   *   none            - еще не поступил в пункт выдачи
   *   waiting         - ожидает покупателя в пункте
   *   transfering     - перемещается между пунктами выдачи
   *   overdue         - не востребован покупателем в течении 7 дней  
   *   completed       - выдан покупателю
   *   awaiting_return - возвращен покупателем в ПВ, но еще не возвращен в интернет-магазин/контрагенту
   *   returned        - возвращен в интернет-магазин/контрагенту
   *
   * @param string|array код заказа или массив кодов заказов
   * @return array
   * array(
   *   '24053' => "completed",
   *   '24054' => "not found", // заказ с номером 24054 не найден
   * )
   *
   * если произошла ошибка:
   * array(
   *   "result"  => "error",
   *   "message" => "сообщение об ошибке"
   * )
   */
  public function pkg_status($sku) {
    $data = array();
    $data['login'] = $this->login;
    $data['token'] = $this->token;
    $data['sku']   = $sku;

    return $this->post('/api/pkg_status', $data);
  }


  /**
   * Возвращает список пунктов выдач
   *
   * @return array
   * Пример:
   * array(
   *     [0] => Array
   *         (
   *             [id] => Moskovskaya-A16
   *             [address] => Алтайская, д.16
   *             [metro] => Московская
   *         )
   * 
   *     [1] => Array
   *         (
   *             [id] => Pionerskaya-K15k2
   *             [address] => Коломяжский пр., д.15, корп.2
   *             [metro] => Пионерская
   *         )
   * 
   * )
   */
  public function punkts($spb = true) {
    $response = $this->post('/api/punkts');
//    echo '<pre>';
//    var_dump($response);
//    echo '</pre>';
//    die;
    $result = array();
    foreach ($response as $pvz) {
      if($spb && strripos($pvz['id'], 'Msk') === false)
        $result[$pvz['id']] = array(
            'code'=>$pvz['id'],
            'name'=>'м. '.$pvz['metro'],
            'address'=>$pvz['address']
        );

      else if($spb === false && strripos($pvz['id'], 'Msk') === 0)
        $result[$pvz['id']] = array(
            'code'=>$pvz['id'],
            'name'=>'м. '.$pvz['metro'],
            'address'=>$pvz['address']
        );

    }
    return $result;
  }

  /**
   * Возвращает список заказов находящихся в Главпункте
   * @return array
   * Пример:
   * array(
   *   [0] => array(
   *     [id] => "649655",
   *     [create_date] => "2016-02-02 11:21:23",
   *     [modify_date] => "2016-02-03 12:49:50",
   *     [acceptance_date] => "2016-02-03 12:49:50",
   *     [sku] => "92866",
   *     [barcode] => "",
   *     [status] => "waiting",
   *     [price] => "1625.50",
   *     [items_count] => "1",
   *     [buyer_fio] => "Владимир Иванов",
   *     [buyer_phone] => "79641234567",
   *     [comment] => "3 книги",
   *     [punkt_id] => "Prosveshenia-E133",
   *     [src_punkt_id] => "Sennaya-M3",
   *     [dst_punkt_id] => "Prosveshenia-E133",
   *     [to_pay] => "1625.50",
   *     [return_before] => "2016-02-10 12:49:50"
   *   ),
   *   [1] => array( ... )
   * )
   */
  public function pkgs_list() {
    $data = array();
    $data['login'] = $this->login;
    $data['token'] = $this->token;

    return $this->post('/api/pkgs_list', $data);
  }

  public function take_pkgs_pdf($order)
  {
    return file_get_contents('http://'.$this->host.'/api/take_pkgs_pdf?login='.$this->login.'&token='. $this->token.'&id='. $order->track);
  }


  /**
   * Отправка HTTP-запроса POST к API Glavpunkt.ru
   *
   * @param $url адрес (пример: /api/pkg_status)
   * @param $data данные отправляемые в теле POST запроса
   * @return mixed
   */
  private function post($url, $data = null) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://' . $this->host . $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if (isset($data)) {
      $post_body = http_build_query($data);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body);
    }

    $out = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($out, true);
    if (is_null($res)) {
      throw new Exception("Неверный JSON ответ: " . $out);
    }
    
    return $res;
  }

}