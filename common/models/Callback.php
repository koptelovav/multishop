<?php

/**
 * This is the model class for table "callback".
 *
 * The followings are the available columns in table 'callback':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $date
 * @property string $status
 */
class Callback extends CActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_RECALL = 1;
    const STATUS_SUCCESS = 2;

    public $statuses = array(
        self::STATUS_NEW => 'Новый',
        self::STATUS_RECALL => 'Перезвонить',
        self::STATUS_SUCCESS => 'Завершен'
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Callback the static model class
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
		return 'callback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, phone, status', 'required'),
			array('name, phone', 'length', 'max'=>60),
			array('status', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, phone, date, status', 'safe', 'on'=>'search'),
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
			'name' => 'Ваше имя',
			'phone' => 'Ваш телефон',
			'date' => 'Дата',
			'status' => 'Статус',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date DESC',
            ),
		));
	}

    public static function newCallbackCount(){
        return self::model()->count('status=:statusNew OR status=:statusRecall', array('statusNew' => self::STATUS_NEW, 'statusRecall' => self::STATUS_RECALL));
    }

    public function onNewCallback($event)
    {
        $this->raiseEvent('onNewCallback', $event);
    }

    public function getStatus(){
        return $this->statuses[$this->status];
    }
}