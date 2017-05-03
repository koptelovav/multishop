<?php

/**
 * This is the model class for table "product_block".
 *
 * The followings are the available columns in table 'product_block':
 * @property string $product_id
 * @property string $block_id
 * @property string $sort
 */
class BlockProduct extends CActiveRecord
{

    public function behaviors()
    {
        return array(
            'SSortableBehavior' => array(
                'class' => 'backend.extensions.SSortableBehavior.SSortableBehavior',
            ),
        );
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BlockProduct the static model class
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
		return 'block_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, block_id, sort', 'required'),
			array('product_id, block_id, sort', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('product_id, block_id, sort', 'safe', 'on'=>'search'),
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
            'product' => array(self::BELONGS_TO, 'Products','product_id'),
            'block' => array(self::BELONGS_TO, 'Block','block_id')
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Товар',
			'block_id' => 'Блок',
			'sort' => 'Сортировка',
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

		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('block_id',$this->block_id,true);
		$criteria->compare('sort',$this->sort,true);
        $criteria->order = 'sort ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}