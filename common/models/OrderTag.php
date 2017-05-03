<?php

/**
 * This is the model class for table "block".
 *
 * The followings are the available columns in table 'block':
 * @property string $id
 * @property string $img
 * @property string $label
 */
class OrderTag extends CActiveRecord
{
    CONST NEED_CALL = 1;
    CONST RESERV = 3;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Block the static model class
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
		return 'order_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('img, label', 'required'),
			array('img, label', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, img, label', 'safe', 'on'=>'search'),
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
			'img' => 'Иконка',
			'label' => 'Название',
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
		$criteria->compare('img',$this->img,true);
		$criteria->compare('label',$this->label,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function issetTag($tagId, $orderId){
        return (boolean) Yii::app()->db->createCommand()
            ->select('COUNT(*)')
            ->from('order_order_tag')
            ->where('order_id=:id1 AND order_tag_id=:id2', array(':id1'=>$orderId, ':id2'=>$tagId))
            ->queryScalar();
    }

    public static function switchTag($tagId, $orderId){
        $command = Yii::app()->db->createCommand();

        if(self::issetTag($tagId, $orderId)){
            $command
                ->delete('order_order_tag','order_id=:id1 AND order_tag_id=:id2', array(':id1'=>$orderId, ':id2'=>$tagId));
            return 'delete';
        }else{
           $command
                ->insert('order_order_tag',array('order_id'=>$orderId, 'order_tag_id'=>$tagId));
            return 'add';
        }
    }

    public static function getAllTagsByOrderId($orderId){
        $data = Yii::app()->db->createCommand()
            ->select('t.id, t.img, t.label')
            ->from('order_order_tag ot')
            ->join('order_tag t','ot.order_tag_id=t.id')
            ->where('order_id=:id1', array(':id1'=>$orderId))
            ->queryAll();

        return self::model()->populateRecords($data);
    }
}