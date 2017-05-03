<?php

/**
 * This is the model class for table "block_video".
 *
 * The followings are the available columns in table 'block_video':
 * @property string $id
 * @property string $block_id
 * @property string $name
 * @property string $image
 * @property string $video_url
 * @property string $description
 * @property string $sort
 */
class BlockVideo extends CActiveRecord
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
	 * @return BlockVideo the static model class
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
		return 'block_video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('block_id, name, image, video_url, description, sort', 'required'),
			array('name, image, video_url', 'length', 'max'=>256),
			array('block_id, sort', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, image, video_url, description', 'safe', 'on'=>'search'),
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
			'block' => array(self::BELONGS_TO, 'Block','block_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'block_id' => 'Блок',
			'name' => 'Название',
			'image' => 'Превью',
			'video_url' => 'Видео',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('video_url',$this->video_url,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getUrl($autoPlay = 1)
	{
		if(strpos($this->video_url, 'youtube') !== false){
			if(preg_match('/watch\?v=([A-za-z0-9\-_]*)/', $this->video_url, $matches)){
				$videoId = $matches[1];
			}
		}

		if(isset($videoId)){
			$url = '//www.youtube.com/embed/'.$videoId . ($autoPlay ? '?autoplay=1' : '');
			return $url;
		}


		return $this->video_url;
	}
}