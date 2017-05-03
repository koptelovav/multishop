<?php

/**
 * This is the model class for table "card_product".
 *
 * The followings are the available columns in table 'card_product':
 * @property string $card_id
 * @property string $product_id
 * @property string $product_price
 * @property string $product_count
 * @property string $discount
 */
class CardProduct extends CActiveRecord
{
    public $sum;
    public $credits;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CardProduct the static model class
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
		return 'card_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('card_id, product_id, product_count', 'required'),
			array('card_id, product_id, product_count, product_price, discount', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('card_id, product_id, product_count', 'safe', 'on'=>'search'),
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
            'product' => array(self::BELONGS_TO,'Products','product_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'card_id' => 'Card',
			'product_id' => 'Product',
			'product_count' => 'Количество',
            'discount' => 'Скидка',
            'sum' => 'Сумма',
            'date' => 'Дата покупки'
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

		$criteria->compare('card_id',$this->card_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('product_count',$this->product_count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getSum(){
        return ($this->product_price - $this->product_price*$this->discount/100) * $this->product_count;
    }

    public function getCredits(){
        return $this->credits * $this->product_count;
    }

    public function afterFind(){
        $this->credits = $this->product_price * Yii::app()->globalSettings->credits_ratio;
    }
}