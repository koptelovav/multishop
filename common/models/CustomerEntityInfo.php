<?php

/**
 * This is the model class for table "order_entity_info".
 *
 * The followings are the available columns in table 'order_entity_info':
 * @property string $id
 * @property string $name
 * @property string director_short
 * @property string $director
 * @property string $ogrn
 * @property string $inn
 * @property string $kpp
 * @property string $okpo
 * @property string $address
 * @property string $phone
 * @property string $rs
 * @property string $bank
 * @property string $bik
 * @property string $ks
 */
class CustomerEntityInfo extends CActiveRecord
{
    public $oldAttributes;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerEntityInfo the static model class
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
		return 'customer_entity_info';
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
			array('id, inn, bik', 'length', 'max'=>64),
			array('ogrn, kpp, okpo', 'length', 'max'=>64),
			array('address,bank', 'length', 'max'=>256),
			array('phone,ks', 'length', 'max'=>64),
			array('rs', 'length', 'max'=>64),
			array('director_short, director, name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, inn, kpp, okpo, address, phone, rs, bank, bik, ks', 'safe', 'on'=>'search'),
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
            'name' => 'Название',
            'director'=> 'В лице',
            'director_short'=> 'Ф.И.О директора',
            'ogrn'=> 'ОГРН',
			'inn' => 'ИНН',
			'kpp' => 'КПП',
			'okpo' => 'ОКПО',
			'address' => 'Адрес',
			'phone' => 'Телефоны',
			'rs' => 'Р/С',
			'bank' => 'Банк',
			'bik' => 'БИК',
			'ks' => 'К/С',
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
		$criteria->compare('inn',$this->inn,true);
		$criteria->compare('kpp',$this->kpp,true);
		$criteria->compare('okpo',$this->okpo,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('rs',$this->rs,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('bik',$this->bik,true);
		$criteria->compare('ks',$this->ks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}