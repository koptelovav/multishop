<?php

/**
 * This is the model class for table "filter".
 *
 * The followings are the available columns in table 'filter':
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $visible
 * @property string $sort
 */
class Filter extends CActiveRecord
{
	const AGE = 1;
	const GENDER = 2;
    const SIZE = 3;
    const MAGFORMERS_TAG = 4;
    const LEVEL = 5;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Filter the static model class
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
		return 'filter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, title, visible, sort', 'required'),
			array('name, title', 'length', 'max'=>128),
			array('visible, sort', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, title, visible, sort', 'safe', 'on'=>'search'),
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
		    'values'=>array(self::HAS_MANY, 'FilterValue','filter_id')
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
			'title' => 'Title',
			'visible' => 'Visible',
			'sort' => 'Sort',
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
		$criteria->compare('visible',$this->visible,true);
		$criteria->compare('sort',$this->sort,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}