<?php

/**
 * This is the model class for table "shipping".
 *
 * The followings are the available columns in table 'shipping':
 * @property string $id
 * @property string $name
 * @property string $margin
 */
class Shipping extends CActiveRecord
{
    const CALCULATE_SHIPPING = 100;
    const PICKUP_SHIPPING = 1;
    const COURIER_SHIPPING = 4;
    const COURIER_LO_SHIPPING = 6;
    const EMS_POST_SHIPPING = 2;
    const POST_SHIPPING = 3;
    const POST1_SHIPPING = 5;
    const CDEK_STORE_SHIPPING = 7;
    const CDEK_COURIER_SHIPPING = 8;
    const EDOST_SHIPPING = 5;
    const PEC_STORE_SHIPPING = 9;
    const PEC_COURIER_SHIPPING = 10;
    const CDEK_SPB = 11;
    const CDEK_PICKUP_2 = 12;
    const CDEK_PICKUP_3 = 13;
    const CDEK_PICKUP_4 = 14;
    const CDEK_PICKUP_5 = 15;
    const CDEK_PICKUP_6 = 16;
    const MSC_STORE_SHIPPING = 18;
    const MSC_COURIER_SHIPPING = 17;
    const MSC_DELS_SHIPPING = 19;
    const MO_COURIER_SHIPPING = 20;
	const GLAVPUNKT_SPB = 21;
	const GLAVPUNKT_SPB_COURIER = 24;
	const GLAVPUNKT_SPB_COURIER_LO = 25;
	const GLAVPUNKT_MSK = 22;
	const GLAVPUNKT_MSK_STORE = 23;

	const TYPE_SPB = 1;
	const TYPE_LO =2;
	const TYPE_MSC = 3;
	const TYPE_MO = 4;
	const TYPE_RUS = 5;

    public $price;
    public $times;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shipping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function defaultScope(){
        return array(
            'order'=>'sort ASC'
        );
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shipping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, margin', 'required'),
			array('name', 'length', 'max'=>64),
			array('margin', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, margin', 'safe', 'on'=>'search'),
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
            'payments'=>array(self::MANY_MANY, 'Payment',
                'shipping_payment(shipping_id, payment_id)', 'order'=>'sort ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'margin' => 'Margin',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('margin',$this->margin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}