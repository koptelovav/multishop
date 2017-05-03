<?php

/**
 * This is the model class for table "gallery_album".
 *
 * The followings are the available columns in table 'gallery_album':
 * @property string $id
 * @property string $gallery_id
 * @property string $short_title
 * @property string $title
 * @property string $description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $visible
 * @property string $sort
 */
class GalleryAlbum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GalleryAlbum the static model class
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
		return 'gallery_album';
	}

    public function behaviors(){
        return array(
            'ImageBehavior' => array(
                'class' => 'common.behaviors.ImageBehavior'
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
			array('slug, gallery_id, short_title, title, description', 'required'),
			array('gallery_id, visible, sort', 'length', 'max'=>10),
			array('short_title, title', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gallery_id, short_title, title, description, meta_keywords, meta_description, visible, sort', 'safe', 'on'=>'search'),
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
            'gallery'=>array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gallery_id' => 'Gallery',
			'short_title' => 'Short Title',
			'title' => 'Title',
			'description' => 'Description',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'visible' => 'Visible',
			'sort' => 'Sort',
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
		$criteria->compare('gallery_id',$this->gallery_id,true);
		$criteria->compare('short_title',$this->short_title,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('visible',$this->visible,true);
		$criteria->compare('sort',$this->sort,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}