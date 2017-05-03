<?php

/**
 * This is the model class for table "discount".
 *
 * The followings are the available columns in table 'discount':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $value
 * @property string $label
 * @property string $date_from
 * @property string $date_to
 */
class Discount extends CActiveRecord
{

    public $date_range;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Discount the static model class
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
		return 'discount';
	}

    public function defaultScope()
    {
        return array(
            'order'=>"date_from",
        );
    }


    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'DATE(NOW()) <= date_to',
            ),
            'actual' => array(
                'condition' => 'DATE(NOW()) BETWEEN date_from AND date_to',
            ),
        );
    }

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, value, date_from, date_to', 'required'),
			array('title, label', 'length', 'max'=>128),
			array('image', 'length', 'max'=>256),
			array('value', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, image, value, label, date_from, date_to', 'safe', 'on'=>'search'),
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
			'title' => 'Название',
			'description' => 'Описание',
			'image' => 'Изображение',
			'value' => 'Скидка',
			'label' => 'Метка',
			'date_from' => 'Дата начала',
			'date_to' => 'Дата окончания',
            'date_range'=>'Период'
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getLabel(){
        if($this->label)
            $label = $this->label;
        else if(strpos($this->value,'%') !== false)
            $label = '-'.$this->value;
        else
            $label = '-'.SHtml::toPrice($this->value);

        return $label;
    }
}