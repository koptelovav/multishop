<?php

/**
 * This is the model class for table "block".
 *
 * The followings are the available columns in table 'block':
 * @property string $id
 * @property string $title
 * @property string $identifier
 * @property string $product_count
 */
class Block extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Block the static model class
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
		return 'block';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, identifier', 'required'),
			array('title, identifier', 'length', 'max'=>64),
			array('product_count', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, identifier, product_count', 'safe', 'on'=>'search'),
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
            'blockProduct' => array(self::HAS_MANY, 'BlockProduct','block_id'),
			'products' => array(self::MANY_MANY, 'Products','block_product(block_id,product_id)', 'order'=>'products_products.sort DESC'),
			'videos' => array(self::HAS_MANY, 'BlockVideo','block_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'identifier' => 'Идентификатор',
			'product_count' => 'Количество товаров',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('product_count',$this->product_count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}