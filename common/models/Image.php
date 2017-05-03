<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property string $product_id
 * @property string $description
 */
class Image extends CActiveRecord
{
    const TYPE_GENERAL = 1;
    const TYPE_ADDITIONAL = 2;
    const TYPE_PIECE = 3;
    const TYPE_NEWS = 4;
    const TYPE_CATEGORY = 5;
    const TYPE_CATEGORY_BANNER = 6;

    /*
    INSERT INTO `image`(`id`, `model_id`, `model`, `type`, `url`, `name`, `description`)
SELECT NULL, id, 'Products', 1, image, NULL, NULL FROM `products`
     */

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Images the static model class
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
		return 'image';
	}

    public function primaryKey()
    {
        return 'url';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model,model_id, url', 'required'),
			array('type, model_id', 'length', 'max'=>10),
            array('description', 'safe'),
			array('alt, url', 'length', 'max'=>256),
            array('title', 'length', 'max'=>512),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('product_id, name', 'safe', 'on'=>'search'),
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
			'product_id' => 'Product',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}