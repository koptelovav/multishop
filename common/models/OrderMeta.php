<?php

/**
 * This is the model class for table "order_meta".
 *
 * The followings are the available columns in table 'order_meta':
 * @property string $order_id
 * @property string $name
 * @property string $value
 */
class OrderMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderMeta the static model class
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
		return 'order_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, name, value', 'required'),
			array('order_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>60),
			array('value', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_id, name, value', 'safe', 'on'=>'search'),
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

    public static function add($orderId, $name, $value){
        $meta = self::model()->findByAttributes(array(
           'order_id' => $orderId,
           'name'=> $name
        ));

        if(!$meta)
            $meta = new self;

        $meta->order_id = $orderId;
        $meta->name = $name;
        $meta->value = $value;

        return $meta->save();
    }

    public static function remove($orderId, $name){
        return Yii::app()->db->createCommand()->delete('order_meta',array(
            'order_id' => $orderId,
            'name'=> $name
        ));
    }

    public static function get($orderId, $name){
        $meta = self::model()->findByAttributes(array(
            'order_id' => $orderId,
            'name'=> $name
        ));

        return $meta instanceof CActiveRecord;
    }
}