<?php

/**
 * This is the model class for table "attribute_value".
 *
 * The followings are the available columns in table 'attribute_value':
 * @property string $id
 * @property integer $attribute_id
 * @property string $label
 * @property string $value
 * @property string $mark_up
 * @property string $active
 * @property string $sort
 */
class AttributeValue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttributeValue the static model class
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
		return 'attribute_value';
	}

	public function defaultScope()
	{
		return array(
			'condition'=>"active=1",
			'order' => 'sort ASC'
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attribute_id, value, active, sort', 'required'),
			array('attribute_id', 'numerical', 'integerOnly'=>true),
			array('id, mark_up, active, sort', 'length', 'max'=>10),
			array('label, value', 'length', 'max'=>512),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, attribute_id, value, mark_up, active, sort', 'safe', 'on'=>'search'),
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
			'attribute' => array(self::BELONGS_TO, 'Attribute', 'attribute_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'attribute_id' => 'Attribute',
			'label' => 'Цвет, иконка',
			'value' => 'Значение',
			'mark_up' => 'Наценка',
			'active' => 'Активен',
			'sort' => 'Сортировка',
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
		$criteria->compare('attribute_id',$this->attribute_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('mark_up',$this->mark_up,true);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('sort',$this->sort,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}