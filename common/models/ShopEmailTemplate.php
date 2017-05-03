<?php

/**
 * This is the model class for table "shop_email_template".
 *
 * The followings are the available columns in table 'shop_email_template':
 * @property string $shop_id
 * @property string $header_banner
 * @property string $color_1
 * @property string $color_2
 * @property string $color_3
 */
class ShopEmailTemplate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopEmailTemplate the static model class
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
		return 'shop_email_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop_id, header_banner, color_1, color_2, color_3', 'safe'),
			array('shop_id', 'length', 'max'=>10),
			array('header_banner', 'length', 'max'=>256),
			array('color_1, color_2, color_3', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('shop_id, header_banner, color_1, color_2, color_3', 'safe', 'on'=>'search'),
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
			'products'=>array(self::HAS_MANY, 'ShopEmailTemplateProduct', 'shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'shop_id' => 'Shop',
			'header_banner' => 'Баннер',
			'color_1' => 'Цвет 1',
			'color_2' => 'Цвет 2',
			'color_3' => 'Цвет 3',
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

		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('header_banner',$this->header_banner,true);
		$criteria->compare('color_1',$this->color_1,true);
		$criteria->compare('color_2',$this->color_2,true);
		$criteria->compare('color_3',$this->color_3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}