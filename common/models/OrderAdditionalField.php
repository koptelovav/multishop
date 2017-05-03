<?php

/**
 * This is the model class for table "order_additional_field".
 *
 * The followings are the available columns in table 'order_additional_field':
 * @property string $id
 * @property string $order_id
 * @property string $additional_field_id
 */
class OrderAdditionalField extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderAdditionalField the static model class
	 */
    public $value = null;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_additional_field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, additional_field_id', 'required'),
			array('order_id, additional_field_id', 'length', 'max'=>10),
            array('value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, additional_field_id', 'safe', 'on'=>'search'),
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
            'params'=>array(self::BELONGS_TO, 'AdditionalField','additional_field_id')
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('additional_field_id',$this->additional_field_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getValue(){
        if(!$this->value){
            $this->value = OrderAdditionalFieldValue::model()->findByAttributes(
                array(
                    'order_additional_field_id' =>$this->id
                )
            );
            if(!$this->value)
                $this->value = new OrderAdditionalFieldValue();
        }

        return $this->value;
    }
}