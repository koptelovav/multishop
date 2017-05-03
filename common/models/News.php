<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property string $id
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $title
 * @property string $image
 * @property string $text
 * @property string $created
 * @property string short_text
 */
class News extends CActiveRecord
{
    public function behaviors(){
        return array('ESaveRelatedBehavior' => array(
            'class' => 'application.behaviors.ESaveRelatedBehavior')
        );
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, text', 'required'),
			array('title', 'length', 'max'=>200),
			array('image,short_text, meta_description, meta_keywords, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, meta_description, meta_keywords, title, image, text', 'safe', 'on'=>'search'),
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
            'shops'=>array(self::MANY_MANY, 'Shop',
                'news_shop(news_id, shop_id)'),
			'products'=>array(self::MANY_MANY, 'Products',
				'product_news(news_id, product_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
            'short_text' => 'Анонс',
			'title' => 'Заголово',
			'image' => 'Изображение',
			'text' => 'Текст',
            'created' => 'created'
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
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('text',$this->text,true);

        if(Yii::app()->id == ShopConfig::APP_BACKEND){
            if($currentShopId = Yii::app()->shop->getCurrent()->id){
                $sql = 'SELECT news_id FROM news_shop WHERE shop_id = ' . $currentShopId;
                $newsIds = Yii::app()->db->createCommand($sql)->queryAll();

                $inConditionArray = array();
                foreach ($newsIds as $news) {
                    $inConditionArray[] = $news['news_id'];
                }
                $criteria->addInCondition('id',$inConditionArray);
            }
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getLast($count = 1)
    {
        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from('news n')
            ->join('news_shop ns', 'ns.news_id = n.id')
            ->where('shop_id='.Yii::app()->shop->id)
            ->order('created DESC')
            ->limit($count)
            ->queryAll();


        return News::model()->populateRecords($result);
	}
}