<?php

/**
 * This is the model class for table "seller_form_sale".
 *
 * The followings are the available columns in table 'seller_form_sale':
 * @property string $id
 * @property string $seller_form_id
 * @property string $product_title
 * @property double $product_price
 * @property string $product_count
 * @property string $discount
 * @property string $gift_title
 * @property string $payment_type
 * @property string $date
 */
class SellerFormSale extends CActiveRecord
{
    public static $payment_type_short = array(
        1=>'Н',
        2=>'Б',
        3=>'П'
    );

    public static $payment_type = array(
        1=>'наличные',
        2=>'банковская карта',
        3=>'предоплата'
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SellerFormSale the static model class
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
		return 'seller_form_sale';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_title, product_price, product_count, payment_type', 'required'),
			array('gift_id, product_id, product_price', 'numerical'),
			array('note', 'safe'),
			array('seller_form_id, product_count, discount, payment_type', 'length', 'max'=>10),
			array('product_title, gift_title', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, seller_form_id, product_title, product_price, product_count, discount, gift_title, payment_type, date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'ID',
            'seller_form_id' => 'Seller Form',
            'product_title' => 'Товар',
            'product_price' => 'Цена',
            'product_count' => 'Количество',
            'discount' => 'Скидка',
            'gift_title' => 'Подарок',
            'payment_type' => 'Тип оплаты',
            'date' => 'Дата',
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
		$criteria->compare('seller_form_id',$this->seller_form_id,true);
		$criteria->compare('product_title',$this->product_title,true);
		$criteria->compare('product_price',$this->product_price);
		$criteria->compare('product_count',$this->product_count,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('gift_title',$this->gift_title,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTotal(){
        $total = $this->product_price * $this->product_count;
        if($this->discount)
            $total = $total - $total * $this->discount / 100;
            return $total;
    }
}