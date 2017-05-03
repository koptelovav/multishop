<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property string $id
 * @property string $customer_id
 * @property string $comment
 * @property string $shipping_id
 * @property string $payment_id
 * @property string $status
 * @property string $payment_status
 * @property string shipping_price
 * @property string $total
 * @property string $token
 * @property string $date
 * @property string $update_status
 * @property string $update_payment_status
 * @property string $formed_date
 * @property string $shop_id
 * @property string $productSum
 * @property string $discount
 * @property string $promo_code
 */
class Orders extends CActiveRecord
{
    CONST STATUS_NEW = 'new';
    CONST STATUS_PAID = 'paid';
    CONST STATUS_FAIL = 'fail';

    public $product;
    public $customerData;
    public $customerAddressData;
    public $oldAttributes;
    public $product_price;
    public $total_price;
    public $weight;
    public $send_no_call;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Orders the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'orders';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('shipping_id, payment_id, total_price', 'required', 'except' => 'admin'),
            array('allow_payment, shop_id,payment_status, shipping_id, payment_id, total_price, product', 'length', 'max' => 10),
            array('status', 'length', 'max' => 4),
            array('discount', 'length', 'max' => 64),
            array('promo_code, priority, shipping_price, weight, date, update_status, formed_date, update_payment_status, comment,customer_id,customerData,track', 'safe'),
            array('id', 'safe', 'on' => 'search')
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customerAddress' => array(self::BELONGS_TO, 'CustomerAddress', 'customer_id'),
            'customer' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
            'commentsCount' => array(self::STAT, 'OrderComment', 'order_id'),
            'comments' => array(self::HAS_MANY, 'OrderComment', 'order_id', 'order' => 'create_date DESC'),
            'expenses' => array(self::HAS_MANY, 'OrderExpenses', 'order_id', 'order' => 'create_date DESC'),
            'expensesCount' => array(self::STAT, 'OrderExpenses', 'order_id'),
            'expensesSum' => array(self::STAT, 'OrderExpenses', 'order_id', 'select' => 'SUM(amount)'),
            'shipping' => array(self::BELONGS_TO, 'Shipping', 'shipping_id'),
            'payment' => array(self::BELONGS_TO, 'Payment', 'payment_id'),
            'orderStatus' => array(self::BELONGS_TO, 'OrderStatus', 'status'),
            'paymentStatus' => array(self::BELONGS_TO, 'OrderPaymentStatus', 'payment_status'),
            'products' => array(self::HAS_MANY, 'OrderProducts', 'order_id'),
            'productsSum' => array(self::STAT, 'OrderProducts', 'order_id', 'select' => 'SUM(t.count*t.price)'),
         //   'gifts' => array(self::HAS_MANY, 'OrderGift', 'order_id'),
            'shop' => array(self::BELONGS_TO, 'Shop', 'shop_id'),
            'orderTags' => array(self::MANY_MANY, 'OrderTag','order_order_tag(order_id,order_tag_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Номер',
            'customer_id' => 'Покупатель',
            'comment' => 'Комментарий',
            'shipping_id' => 'Доставка',
            'payment_id' => 'Оплата',
            'status' => 'Статус',
            'payment_status' => 'Статус оплаты',
            'shipping_price' => 'Стоимость доставки',
            'product_price' => 'Товаров на сумму',
            'total_price' => 'Итого',
            'date' => 'Дата',
            'product' => 'Товары',
            'track' => 'Трэк',
            'expenses' => 'Расходы',
            'shop_id' => 'Магазин',
            'update_status' => 'Дата об. статуса',
            'update_payment_status' => 'Оплачен',
            'formed_date' => 'Сформирован',
            'weight'=> 'Вес посылки',
            'discount' => 'Скидка %',
            'allow_payment' => 'Доступ ко оплате',
            'priority' => 'Приоритет',
            'promo_code' => 'Промокод'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id, true);
//		$criteria->compare('customer_id',$this->customer_id,true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('shipping_id', $this->shipping_id, true);
        $criteria->compare('payment_id', $this->payment_id, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('payment_status', $this->payment_status, true);
        $criteria->compare('track', $this->track, true);
        $criteria->compare('products.product_id', $this->product);

        if ($this->customer_id)
            $criteria->compare('customer.name', $this->customer_id, true);
        else if ($this->customerData->name)
            $criteria->compare('customer.name', $this->customerData->name, true);

        if ($this->customer_id || $this->customerData->name || $this->product)
            $criteria->together = true;

        $criteria->compare('customer.email', $this->customerData->email, true);
        $criteria->compare('customer.phone', $this->customerData->phone, true);
        $criteria->compare('customerAddress.area', $this->customerAddressData->area, true);
        $criteria->compare('customerAddress.city', $this->customerAddressData->city, true);
        $criteria->compare('customerAddress.street', $this->customerAddressData->street, true);
        $criteria->compare('customerAddress.house', $this->customerAddressData->house, true);
        $criteria->compare('customerAddress.build', $this->customerAddressData->build, true);
        $criteria->compare('customerAddress.housing', $this->customerAddressData->housing, true);
        $criteria->compare('customerAddress.apartment', $this->customerAddressData->apartment, true);

        $criteria->with = array('products', 'customer', 'customerAddress');

        $criteria->order = 'date DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTotal($shipping = true){
        $price = $shipping ? $this->shipping_price : 0;
            foreach($this->products as $orderProduct){
                $product = $orderProduct->product;
                if($this->discount && !$product->getDiscount()){
                    $price += ($orderProduct->price - $orderProduct->price*$this->discount /100) * $orderProduct->count;
                }else{
                    $price += $orderProduct->price* $orderProduct->count;
                }
            }
        return $price;
    }

    public function getWeight($units = 'g'){
        $weight = 0;
        foreach($this->products as $item){
            $weight+= $item->product->weight * $item->count;
        }
      /*  foreach($this->gifts as $item){
            $weight+= $item->product->weight * $item->count;
        }*/

        if($units == 'kg'){
            $weight = $weight / 1000;
        }
        return $weight;
    }

    public function getToken()
    {
        return md5($this->id . 'MULTI_SHOP_ORDER_TOKEN');
    }

    public function addMeta($name, $value)
    {
        return OrderMeta::add($this->id, $name, $value);
    }

    public function removeMeta($name)
    {
        return OrderMeta::remove($this->id, $name);
    }

    public function getMeta($name)
    {
        return OrderMeta::get($this->id, $name);
    }

    public function getOrderedProducts()
    {
        $productArray = Yii::app()->db->createCommand()
            ->select('p.*')
            ->from('products p')
            ->leftJoin('order_products op', 'p.id = op.product_id')
            ->group('op.product_id')
            ->queryAll();

        return Products::model()->populateRecords($productArray);
    }

    public function getOrderProduct(){
        $sql = 'select id, title, article, price, sum(count) as count, code from (
    SELECT
                  DISTINCT op.`product_id` AS ID,
                  p.title as title, p.price as price,
                  SUM(op.`count`) as count,
                    (select value FROM product_feature pf WHERE op.product_id= pf.product_id AND pf.feature_id = 1) as article,
                    (select value FROM product_feature pf WHERE op.product_id= pf.product_id AND pf.feature_id = 6) as code
                FROM `order_products` op
                LEFT JOIN `orders` o ON op.order_id = o.id
                LEFT JOIN `products` p ON op.product_id = p.id
                LEFT JOIN `product_include` pi ON p.id= pi.product_id
                WHERE o.id = '.$this->id.' AND pi.include_id is NULL
                GROUP BY op.product_id
   union all
    SELECT
                  DISTINCT opi.`include_id` AS ID,
                  p.title as title, p.price as price,
                  SUM(opi.`count` * op.count) as count,
                    (select value FROM product_feature pf WHERE opi.include_id= pf.product_id AND pf.feature_id = 1) as article,
                    (select value FROM product_feature pf WHERE opi.include_id= pf.product_id AND pf.feature_id = 6) as code
                FROM `order_product_include` opi
                LEFT JOIN `order_products` op ON op.id = opi.order_product_id
                LEFT JOIN `products` p ON  opi.`include_id`  = p.id
                WHERE op.order_id = '.$this->id.'
                GROUP BY opi.`include_id`
) x GROUP BY id ORDER BY code';

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function checkAdditionalField($fieldName){
        $sql = 'SELECT additional_field_id FROM `order_shipping_additional_field` WHERE `shipping_id`='.$this->shipping_id.' AND `additional_field_id` = (SELECT `id` FROM `additional_field` WHERE `name`="'.$fieldName.'")';
        return  Yii::app()->db->createCommand($sql)->queryScalar();
    }

    public function getAdditionalFieldByName($name){
        $sql = 'SELECT `additional_field_id` FROM `order_shipping_additional_field` WHERE `shipping_id`='.$this->shipping_id.' AND `additional_field_id` = (SELECT `id` FROM `additional_field` WHERE `name`="'.$name.'")';
        $fieldId = Yii::app()->db->createCommand($sql)->queryScalar();
        if($fieldId){
            $orderAdditionalField = OrderAdditionalField::model()->findByAttributes(array(
               'order_id'=>$this->id,
                'additional_field_id'=>$fieldId
            ));

            if(!$orderAdditionalField){
                $orderAdditionalField = new OrderAdditionalField();
                $orderAdditionalField->order_id = $this->id;
                $orderAdditionalField->additional_field_id = $fieldId;
            }
            return $orderAdditionalField;
        }
        return false;
    }

    public function issetTag($tagName){
        return OrderTag::issetTag($tagName, $this->id);
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->date = new CDbExpression('NOW()');
            $this->update_status = null;
            $this->update_payment_status = null;
            $this->formed_date = null;
        }

        return parent::beforeValidate();
    }

    public function beforeSave()
    {

        if (!$this->isNewRecord) {
            $now = new CDbExpression('NOW()');
            if ($this->oldAttributes['status'] != $this->attributes['status']) {
                $orderStatusHistory = new OrderStatusHistory;
                $orderStatusHistory->order_id = $this->id;
                $orderStatusHistory->order_status_id = $this->attributes['status'];
                $orderStatusHistory->save();

                if($this->attributes['status'] == OrderStatus::FORMED && !$this->formed_date){
                    $this->formed_date = date('Y-m-d H:i:s');
                }

            /*    if($this->attributes['status'] == OrderStatus::ASSEMBLY && !OrderTag::issetTag(OrderTag::RESERV, $this->id)){
                    $this->sale(StoreApi::STORE_INTERNET);
                }*/
            }
            if ($this->oldAttributes['payment_status'] != $this->attributes['payment_status']) {
                if($this->attributes['payment_status'] == OrderPaymentStatus::PAID && !$this->update_payment_status){
                    $this->update_payment_status = date('Y-m-d H:i:s');
                }
            }
        }
        return parent::beforeSave();
    }


    public function onNewOrder($event)
    {
        $this->raiseEvent('onNewOrder', $event);
    }

    public function onSendTrack($event)
    {
        $this->raiseEvent('onSendTrack', $event);
    }

    public function afterFind()
    {
        $this->oldAttributes = $this->attributes;
        parent::afterFind();
    }



    public function cdekRegister(){
        $response = Yii::app()->CDEKApi->registerOrder($this);
        $tracking = new SimpleXMLElement($response);
        if(!isset($tracking->Order["ErrorCode"])) {
            $this->track = (int)$tracking->Order["DispatchNumber"];
            $this->save();
            $smsNotifier = new SmsNotifier();
            $emailNotifier = new EmailNotifier();

            if ($this->customer->phone)
                $this->onSendTrack = array($smsNotifier, 'sendOrderTrack');
            if ($this->customer->email)
                $this->onSendTrack = array($emailNotifier, 'sendOrderTrack');

            $event = new CModelEvent($this);
            $this->onSendTrack($event);
        }

        return $response;
    }


  /*  public function sale($store = StoreApi::STORE_INTERNET){
        OrderTag::switchTag(OrderTag::RESERV, $this->id);
        $request = array();
        $products = $this->getOrderProduct();
        foreach($products as $item){
            $request[] = array(
                'product_id' => $item['id'],
                'store_id' => $store,
                'account_id' => StoreApi::$payment_to_account[$this->payment_id],
                'product_price' => $item['price'],
                'discount' => $this->discount ? $this->discount : 0,
                'product_count' =>  $item['count'],
                'note' => 'Заказ № '.$this->id,
                'uid' => 'O'.$this->id
            );
        }

        if((strtotime($this->update_payment_status) - strtotime($this->date)) <= 10800){
            $request[] = array(
                'product_id' => 387,
                'store_id' => $store,
                'account_id' => StoreApi::ACCOUNT_AVANGARD,
                'product_price' => 0,
                'discount' => 0,
                'product_count' =>  1,
                'note' => 'Заказ № '.$this->id,
                'uid' => 'O'.$this->id
            );
        }

        Yii::app()->store->sale($request);
    }*/
}