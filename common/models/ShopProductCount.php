<?php

/**
 * This is the model class for table "shop_product_count".
 *
 * The followings are the available columns in table 'shop_product_count':
 * @property string $id
 * @property string $related
 * @property string $new
 * @property string $hit_sales
 * @property string $category
 * @property string $index
 */
class ShopProductCount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopProductCount the static model class
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
		return 'shop_product_count';
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
			array('id, related, new, hit_sales, category, index', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, related, new, hit_sales, category, index', 'safe', 'on'=>'search'),
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
			'related' => 'Сопутсвующие',
			'new' => 'Новые',
			'hit_sales' => 'Хит продаж',
			'category' => 'В категории',
			'index' => 'На гланой',
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
		$criteria->compare('related',$this->related,true);
		$criteria->compare('new',$this->new,true);
		$criteria->compare('hit_sales',$this->hit_sales,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('index',$this->index,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}