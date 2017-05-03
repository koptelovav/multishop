<?php

/**
 * This is the model class for table "static_page".
 *
 * The followings are the available columns in table 'static_page':
 * @property integer $id
 * @property string $shop_id
 * @property string $slug
 * @property string $title
 * @property string $short_title
 * @property string $meta_tag
 * @property string $meta_description
 * @property string $content
 * @property string $updated
 */
class StaticPage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StaticPage the static model class
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
		return 'static_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, slug, title, short_title, content, updated', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('shop_id', 'length', 'max'=>10),
			array('slug, title, short_title', 'length', 'max'=>128),
			array('meta_tag, meta_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shop_id, slug, title, short_title, meta_tag, meta_description, content, updated', 'safe', 'on'=>'search'),
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
			'shop_id' => 'Shop',
			'slug' => 'Slug',
			'title' => 'Title',
			'short_title' => 'Short Title',
			'meta_tag' => 'Meta Tag',
			'meta_description' => 'Meta Description',
			'content' => 'Content',
			'updated' => 'Updated',
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
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_title',$this->short_title,true);
		$criteria->compare('meta_tag',$this->meta_tag,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}