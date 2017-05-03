<?php

/**
 * This is the model class for table "order_shipping_additional_field".
 *
 * The followings are the available columns in table 'order_shipping_additional_field':
 * @property integer $id
 * @property integer $shipping_id
 * @property integer $additional_field_id
 */
class OrderShippingAdditionalField extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderShippingAdditionalField the static model class
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
		return 'order_shipping_additional_field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shipping_id, additional_field_id', 'required'),
			array('shipping_id, additional_field_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shipping_id, additional_field_id', 'safe', 'on'=>'search'),
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
			'shipping_id' => 'Shipping',
			'additional_field_id' => 'Additional Field',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('shipping_id',$this->shipping_id);
		$criteria->compare('additional_field_id',$this->additional_field_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}