<?php

/**
 * This is the model class for table "card_user".
 *
 * The followings are the available columns in table 'card_user':
 * @property string $card_id
 * @property string $firstname
 * @property string $lastname
 * @property string $patronymic
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property integer $subscribe
 * @property string $last_login
 */
class CardUser extends CActiveRecord
{
    protected $oldPassword;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CardUser the static model class
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
		return 'card_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('card_id, firstname, lastname, phone, email, password', 'required', 'on'=>'insert'),
			array('subscribe', 'numerical', 'integerOnly'=>true),
            array('email','email'),
			array('card_id', 'length', 'max'=>11),
			array('firstname, lastname, patronymic, email', 'length', 'max'=>128),
			array('phone', 'length', 'max'=>60),
			array('password', 'length', 'max'=>32),
			array('last_login', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('card_id, firstname, lastname, patronymic, phone, email, password, subscribe, last_login', 'safe', 'on'=>'search'),
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
			'card_id' => 'Номер карты',
			'firstname' => 'Имя',
			'lastname' => 'Фамилия',
			'patronymic' => 'Отчество',
			'phone' => 'Телефон',
			'email' => 'E-mail',
			'password' => 'Пароль',
			'subscribe' => 'Подписать на новости',
			'last_login' => 'Последницй вход',
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

		$criteria->compare('card_id',$this->card_id,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('patronymic',$this->patronymic,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('subscribe',$this->subscribe);
		$criteria->compare('last_login',$this->last_login,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function fullName(){
        return $this->lastname.' '.$this->firstname.' '.$this->patronymic;
    }

    public function afterFind(){
        $this->oldPassword = $this->password;
    }

    public function beforeSave()
    {
        if($this->oldPassword != $this->password)
            $this->password = md5($this->password);
        return true;
    }
}