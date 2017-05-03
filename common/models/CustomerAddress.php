<?php

/**
 * This is the model class for table "customer_address".
 *
 * The followings are the available columns in table 'customer_address':
 * @property string $id
 * @property string $city
 * @property string $area
 * @property string $street
 * @property string $house
 * @property string $apartment
 * @property string $zip
 * @property string address
 */
class CustomerAddress extends CActiveRecord
{
    public $oldAttributes;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerAddress the static model class
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
		return 'customer_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
            array('zip', 'length', 'max'=>6),
			array('id', 'length', 'max'=>10),
            array('address, pvz_name, pvz','safe'),
			array('city, area, street, house, apartment', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, city, area, street, house, apartment', 'safe', 'on'=>'search'),
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
            'city' => 'Город',
            'area' => 'Регион',
            'street' => 'Улица',
            'address' => 'Адрес',
            'house' => 'Дом',
            'apartment' => 'Квартира',
            'pvz_name' => 'ПВЗ',
            'zip' => 'Индекс'
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
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('house',$this->house,true);
		$criteria->compare('apartment',$this->apartment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getFullCityAddress(){
        return $this->street.' '.$this->house.($this->apartment ? ' - '.$this->apartment : '');
    }

    public function afterFind()
    {
        $this->oldAttributes = $this->attributes;
        parent::afterFind();
    }

    public function getPvzName(){
        $result = Yii::app()->CDEKApi->getPVZList($this->zip);
        return $result[$this->pvz]['name'];
    }
}