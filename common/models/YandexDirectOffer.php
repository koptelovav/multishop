<?php

/**
 * This is the model class for table "yandex_direct_offer".
 *
 * The followings are the available columns in table 'yandex_direct_offer':
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $offer_name
 * @property string $priority
 */
class YandexDirectOffer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YandexDirectOffer the static model class
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
		return 'yandex_direct_offer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('utm_campaign, offer_name, priority', 'required'),
			array('utm_campaign, utm_content, priority', 'length', 'max'=>10),
			array('offer_name', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('utm_campaign, utm_content, offer_name, priority', 'safe', 'on'=>'search'),
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
			'utm_campaign' => 'Utm Campaign',
			'utm_content' => 'Utm Content',
			'offer_name' => 'Offer Name',
			'priority' => 'Priority',
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

		$criteria->compare('utm_campaign',$this->utm_campaign,true);
		$criteria->compare('utm_content',$this->utm_content,true);
		$criteria->compare('offer_name',$this->offer_name,true);
		$criteria->compare('priority',$this->priority,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}