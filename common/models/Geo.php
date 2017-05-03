<?php

/**
 * This is the model class for table "geo".
 *
 * The followings are the available columns in table 'geo':
 * @property integer $id
 * @property integer $zone_id
 * @property string $name
 * @property string $full_name
 * @property string $postcode
 * @property integer $parent_id
 * @property double $lat
 * @property double $long
 * @property double $population
 */
class Geo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Geo the static model class
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
		return 'geo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zone_id, name, full_name, postcode, parent_id, lat, long, population', 'required'),
			array('zone_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('lat, long, population', 'numerical'),
			array('name', 'length', 'max'=>128),
			array('full_name', 'length', 'max'=>512),
			array('postcode', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, zone_id, name, full_name, postcode, parent_id, lat, long, population', 'safe', 'on'=>'search'),
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
			'zone_id' => 'Zone',
			'name' => 'Name',
			'full_name' => 'Full Name',
			'postcode' => 'Postcode',
			'parent_id' => 'Parent',
			'lat' => 'Lat',
			'long' => 'Long',
			'population' => 'Population',
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
		$criteria->compare('zone_id',$this->zone_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('long',$this->long);
		$criteria->compare('population',$this->population);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getRegions(){
        return self::model()->findAllByAttributes(array('parent_id'=>0));
    }

    public static function getCityRegionById($cityId){

        do{
        $result = Yii::app()->db->createCommand()
            ->select('id, parent_id, full_name')
            ->from('geo')
            ->where('id='.$cityId)
            ->queryRow();

            $cityId = $result['parent_id'];
        }while($cityId != 0);

        return $result;
    }
}