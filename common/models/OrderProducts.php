<?php

/**
 * This is the model class for table "order_products".
 *
 * The followings are the available columns in table 'order_products':
 * @property string $id
 * @property string $image
 * @property string $title
 * @property string $order_id
 * @property string $product_id
 * @property integer $price
 * @property integer $count
 * @property string $attributes_string
 */
class OrderProducts extends CActiveRecord
{
    protected $oldAttributes;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderProducts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, product_id, price, count', 'required'),
			array('price, count', 'numerical', 'integerOnly'=>true),
			array('order_id, product_id', 'length', 'max'=>10),
            array('attributes_string, title, image', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, product_id, price, count', 'safe', 'on'=>'search'),
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
            'product' => array(self::BELONGS_TO,'Products', 'product_id'),
            'product_include' => array(self::HAS_MANY,'OrderProductInclude', 'order_product_id'),
            'order' => array(self::BELONGS_TO,'Orders', 'order_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Order',
			'product_id' => 'Product',
			'price' => 'Стоимость',
			'count' => 'Количество',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('count',$this->count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getPrice(){
        $discount = $this->order->discount;
        $price = $this->price;
        $product = $this->product;
        if($discount && !$product->getDiscount())
            $price = $price - $price*$discount/100;
        return $price;
    }

    public function afterFind(){
        $this->oldAttributes = $this->attributes;
    }

    public function beforeSave(){
        if($this->count <= 0){
            $this->delete();
            return false;
        }
        return true;
    }

    public function afterSave(){
        $product = $this->product;
        if($this->isNewRecord) {
            if ($includeProducts = $product->product_include) {
                foreach ($includeProducts as $item) {
                    $orderProductInclude = OrderProductInclude::model()->findByAttributes(array(
                        'order_product_id' => $this->id,
                        'include_id' => $item->include_id
                    ));
                    if (!$orderProductInclude) {
                        $orderProductInclude = new OrderProductInclude();
                        $orderProductInclude->order_product_id = $this->id;
                        $orderProductInclude->include_id = $item->include_id;
                        $orderProductInclude->count = $item->count;
                    }
                    $orderProductInclude->save();
                }
            }
        }

        if($giftProducts = $product->product_gift){
            foreach ($giftProducts as $item) {
                $giftProducts = OrderProducts::model()->findByAttributes(array(
                    'order_id' => $this->order_id,
                    'product_id' => $item->gift_id,
                    'price'=> 0
                ));
                if(!$giftProducts){
                    $product = Products::model()->findByPk($item->gift_id);
                    $giftProducts = new OrderProducts();
                    $giftProducts->order_id = $this->order_id;
                    $giftProducts->product_id = $product->id;
                    $giftProducts->title = $product->title;
                    $giftProducts->image = $product->image;
                    $giftProducts->price = 0;
                    $giftProducts->save();
                }

                $giftProducts->count = $giftProducts->count + $this->count - $this->oldAttributes['count'];
                $giftProducts->save();
            }
        }
    }

    public function afterDelete(){
        $product = $this->product;

        if($includeProducts = $product->product_include){
            foreach ($includeProducts as $item) {
                $orderProductInclude = OrderProductInclude::model()->findByAttributes(array(
                    'order_product_id' => $this->id,
                    'include_id' => $item->include_id
                ));

                if($orderProductInclude)
                    $orderProductInclude->delete();
            }
        }

        if($giftProducts = $product->product_gift){
            foreach ($giftProducts as $item) {
                $giftProducts = OrderProducts::model()->findByAttributes(array(
                    'order_id' => $this->order_id,
                    'product_id' => $item->gift_id,
                    'price'=> 0
                ));

                if($giftProducts)
                    $giftProducts->delete();
            }
        }
    }
}