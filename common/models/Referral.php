<?php

/**
 * This is the model class for table "referral".
 *
 * The followings are the available columns in table 'referral':
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $autologin
 * @property integer $visit
 * @property integer $unique_visit
 * @property integer $buy
 */
class Referral extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Referral the static model class
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
		return 'referral';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, password', 'required'),
            array('visit, unique_visit, buy', 'length', 'max'=>10),
			array('name, email', 'length', 'max'=>128),
			array('password, autologin', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, password, autologin', 'safe', 'on'=>'search'),
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
            'banners' => array(self::MANY_MANY, 'SocialBanner', 'referral_social_banner(referral_id, social_banner_id)')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ИД',
			'name' => 'Ф.И.О.',
			'email' => 'E-mail',
			'password' => 'Пароль',
			'autologin' => 'Autologin',
            'visit' => 'Всего визитов',
            'unique_visit' => 'Уникальные визиты',
            'buy' => 'Покупки',
            'url' => 'Ссылка'
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('autologin',$this->autologin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->password = md5($this->password);
            $this->autologin = $this->getAutoLoginHash();
        }
        return parent::beforeSave();
    }

    public function getAutoLoginHash(){
        return md5($this->email.$this->password.'REFERRAL_AUTO_LOGIN');
    }

    public function incrementBuy(){
        $this->buy = $this->buy + 1;
        $this->save();
    }

    public function incrementVisit($unique = false){
        if($unique)
            $this->unique_visit = $this->unique_visit + 1;
        else
            $this->visit = $this->visit + 1;
        $this->save();
    }
}