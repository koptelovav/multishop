<?php

/**
 * This is the model class for table "product_comment".
 *
 * The followings are the available columns in table 'product_comment':
 * @property string $id
 * @property string $shop_id
 * @property string $product_id
 * @property string $user_name
 * @property string $user_email
 * @property integer $rating
 * @property string $text
 * @property integer $moderated
 * @property string $date
 */
class ProductComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductComment the static model class
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
		return 'product_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop_id, product_id, user_name, user_email, rating, text', 'required'),
			array('rating, moderated', 'numerical', 'integerOnly'=>true),
			array('shop_id, product_id', 'length', 'max'=>10),
			array('user_name, user_email', 'length', 'max'=>256),
			array('id, shop_id, product_id, user_name, user_email, rating, text, moderated, date', 'safe', 'on'=>'search'),
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
			'shop_id' => 'Shop',
			'product_id' => 'Product',
			'user_name' => 'Ваше имя',
			'user_email' => 'Ваш E-mail (не будет отображаться на сайте)',
			'rating' => 'Рейтинг',
			'text' => 'Текст',
			'moderated' => 'Moderated',
			'date' => 'Date',
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
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('moderated',$this->moderated);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}