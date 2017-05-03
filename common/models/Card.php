<?php

/**
 * This is the model class for table "card".
 *
 * The followings are the available columns in table 'card':
 * @property string $id
 * @property string $number
 * @property integer $credits
 * @property string $date_issue
 * @property CardUser $user
 * @property Products $products
 * @property string $buyer
 * @property string $phone
 * @property string $email
 * @property integer $subscribe
 */
class Card extends CActiveRecord
{
    public $credits;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Card the static model class
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
		return 'card';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number,buyer,phone', 'required'),
			array('number', 'length', 'max'=>6),
			array('buyer,phone,email,subscribe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, credits, date_issue', 'safe', 'on'=>'search'),
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
            'products' => array(self::MANY_MANY, 'Products','card_product(card_id,product_id)'),
            'cardProducts' => array(self::HAS_MANY, 'CardProduct','card_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Номер карты',
			'credits' => 'Количество баллов',
			'date_issue' => 'Дата вручения',
            'buyer' => 'Держатель',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'subscribe' => 'Подписка'
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
		$criteria->compare('number',$this->number,true);
        $criteria->compare('buyer',$this->buyer,true);
		$criteria->compare('date_issue',$this->date_issue,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getCredits(){
        $credits = 0;
        foreach($this->products as $products){
            $credits += $products->credits;
        }
        return $credits;
    }
}