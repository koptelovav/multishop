<?php

/**
 * This is the model class for table "attribute".
 *
 * The followings are the available columns in table 'attribute':
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $type
 * @property string $show_on_preview
 * @property string $sort
 */
class Attribute extends CActiveRecord
{
	const TYPE_TEXT_FIELD = 1;
	const TYPE_TEXT_AREA = 2;
	const TYPE_DROP_DOWN = 3;
	const TYPE_CHECKBOX = 4;
	const TYPE_RADIO = 5;
	const TYPE_PALETTE = 6;

	public static $types = array(
		self::TYPE_TEXT_FIELD => 'Текстовое поле',
		self::TYPE_TEXT_AREA => 'Текст',
		self::TYPE_DROP_DOWN => 'Выпадающий список',
		self::TYPE_CHECKBOX => 'Чекбокс',
		self::TYPE_RADIO => 'Радио',
		self::TYPE_PALETTE => 'Палитра'
	);

	public function behaviors(){
		return array(
			'ESaveRelatedBehavior' => array(
				'class' => 'common.behaviors.ESaveRelatedBehavior'
			)
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attribute the static model class
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
		return 'attribute';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, title, type, sort', 'required'),
			array('name, title', 'length', 'max'=>256),
			array('type, show_on_preview, sort', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, title, type, sort', 'safe', 'on'=>'search'),
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
			'attribute_values'=>array(self::HAS_MANY, 'AttributeValue','attribute_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'title' => 'Заголовок',
			'type' => 'Тип',
			'show_on_preview' => 'Показывать на превью',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('sort',$this->sort,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}