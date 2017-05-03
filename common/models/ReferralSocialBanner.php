<?php

/**
 * This is the model class for table "referral_social_banner".
 *
 * The followings are the available columns in table 'referral_social_banner':
 * @property string $referral_id
 * @property string $social_banner_id
 * @property string $visit
 * @property string $unique_visit
 * @property string $buy
 */
class ReferralSocialBanner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReferralSocialBanner the static model class
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
		return 'referral_social_banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('referral_id, social_banner_id', 'required'),
			array('referral_id, social_banner_id, visit, unique_visit, buy', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('referral_id, social_banner_id, visit, unique_visit, buy', 'safe', 'on'=>'search'),
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
			'referral_id' => Yii::t('core','Referral'),
			'social_banner_id' => Yii::t('core','Social Banner'),
			'visit' => Yii::t('core','Visit'),
			'unique_visit' => Yii::t('core','Unique Visit'),
			'buy' => Yii::t('core','Buy'),
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

		$criteria->compare('referral_id',$this->referral_id,true);
		$criteria->compare('social_banner_id',$this->social_banner_id,true);
		$criteria->compare('visit',$this->visit,true);
		$criteria->compare('unique_visit',$this->unique_visit,true);
		$criteria->compare('buy',$this->buy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function incrementVisit($unique = false){
        if($unique)
            $this->unique_visit = $this->unique_visit + 1;
        else
            $this->visit = $this->visit + 1;
        $this->save();
    }

    public function incrementBuy(){
        $this->buy = $this->buy + 1;
        $this->save();
    }
}