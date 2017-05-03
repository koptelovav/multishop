<?php

/**
 * This is the model class for table "order_product_include".
 *
 * The followings are the available columns in table 'order_product_include':
 * @property string $order_product_id
 * @property string $include_id
 * @property integer $count
 */
class OrderProductInclude extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'order_product_include';
	}

	public function rules()
	{
		return array(
			array('order_product_id, include_id, count', 'required'),
			array('order_product_id, include_id, count', 'length', 'max'=>10),
			array('order_product_id, include_id, count', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
            'product' => array(self::BELONGS_TO, 'Products','include_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'order_product_id' => 'Order Product',
			'include_id' => 'Include',
			'count' => 'Count',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('order_product_id',$this->order_product_id,true);
		$criteria->compare('include_id',$this->include_id,true);
		$criteria->compare('count',$this->count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}