<?php

/**
 * This is the model class for table "piece".
 *
 * The followings are the available columns in table 'piece':
 * @property string $id
 * @property string $short_title
 * @property string $title
 * @property string $preview_image
 * @property string $general_image
 * @property string $description
 * @property string $sort
 */
class Piece extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Piece the static model class
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
		return 'piece';
	}

    public function defaultScope()
    {
        return array(
            'condition'=>"visible=1",
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
			array('short_title, title, preview_image, general_image, description, sort', 'required'),
			array('short_title', 'length', 'max'=>128),
			array('title, preview_image, general_image', 'length', 'max'=>512),
			array('sort', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, short_title, title, preview_image, general_image, description, sort', 'safe', 'on'=>'search'),
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
            'products'=>array(self::MANY_MANY, 'Products',
                'product_piece(piece_id, product_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'short_title' => 'Короткое название',
			'title' => 'Название',
			'preview_image' => 'Картинка в категории',
			'general_image' => 'Картинка в карточке',
			'description' => 'Описание',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('short_title',$this->short_title,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('preview_image',$this->preview_image,true);
		$criteria->compare('general_image',$this->general_image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('sort',$this->sort,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 200,
            ),
		));
	}
}