<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property integer $subscribe
 */
class Customers extends CActiveRecord
{
    public $oldAttributes;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customers the static model class
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
		return 'customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, phone, email', 'required', 'except' => 'admin'),
			array('name', 'length', 'max'=>128),
			array('phone, email', 'length', 'max'=>64),
            array('subscribe', 'length', 'max'=>1),
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
            'address' => array(self::HAS_ONE,'CustomerAddress','id'),
            'entityInfo' => array(self::HAS_ONE,'CustomerEntityInfo','id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Ф.И.О.',
			'phone' => 'Телефон',
			'email' => 'E-mail',
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
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getAllOrders(){
        if(!$this->email)
            return array();
        $data = Yii::app()->db->createCommand('SELECT * FROM `orders` WHERE `customer_id` IN (SELECT `id` FROM `customers` WHERE `email` = "'.$this->email.'")')->queryAll();
        return Orders::model()->populateRecords($data);
    }

    public function afterFind()
    {
        $this->oldAttributes = $this->attributes;
        parent::afterFind();
    }
}