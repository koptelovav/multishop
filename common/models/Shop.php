<?php

/**
 * This is the model class for table "shop".
 *
 * The followings are the available columns in table 'shop':
 * @property string $id
 * @property string $domain
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $template
 * @property string $default_product_id
 * @property string yandex_metrika_id
 */
class Shop extends CActiveRecord
{
    public function behaviors(){
        return array('ESaveRelatedBehavior' => array(
            'class' => 'common.behaviors.ESaveRelatedBehavior')
        );
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shop the static model class
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
		return 'shop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain, name, title, template, default_controller', 'required'),
            array('address, meta_description', 'safe'),
            array('default_product_id, vk_app_id, yandex_metrika_id', 'length', 'max'=>10),
			array('domain, name, email, title', 'length', 'max'=>128),
			array('phone', 'length', 'max'=>32),
			array('meta_keywords', 'length', 'max'=>500),
			array('template', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domain, name, address, email, phone, title, meta_description, meta_keywords, template', 'safe', 'on'=>'search'),
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
            'news'=>array(self::MANY_MANY, 'News',
                'news_shop(shop_id, news_id)', 'order'=>'created DESC'
            ),
            'products'=>array(self::MANY_MANY, 'Products',
                'product_shop(shop_id, product_id)','condition'=>'active=1'),
        /*    'categories'=>array(self::MANY_MANY, 'Category',
                'shop_category(shop_id, category_id)',
            ),*/
            'images'=>array(self::HAS_ONE, 'ShopImages', 'id'),
			'email_template'=>array(self::HAS_ONE, 'ShopEmailTemplate', 'shop_id'),
            'productCount'=>array(self::HAS_ONE, 'ShopProductCount', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'domain' => 'Домен',
			'name' => 'Название',
			'address' => 'Адрес',
			'email' => 'Email',
			'phone' => 'Телефон',
			'title' => 'Заголовок',
            'meta_description' => 'Мета-тег "Описание',
            'meta_keywords' => 'Мета-тег "Ключевые слова"',
			'template' => 'Шаблон',
            'default_controller' => 'Страница по умолчанию',
            'default_product_id' => 'Продукт по умолчанию',
            'vk_app_id' => 'ID приложения ВКонтакте',
            'yandex_metrika_id' => 'ID Яндекс Метрики'
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
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('template',$this->template,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getCategories()
    {
        $criteria = new CDbCriteria;

        $criteria->condition = 'shop_id='.$this->id.' AND visible = 1';
        $criteria->order = 'sort ASC';

        return Category::model()->findAll($criteria);
	}

    public function getThemes(){
        $themesArray = array();
        foreach(Yii::app()->themeManager->getThemeNames() as $theme)
            $themesArray[$theme] = $theme;
        return $themesArray;
    }

    public function getAllProductWithDiscount()
    {
        $productIds = Yii::app()->db->createCommand()
            ->select('pd.product_id')
            ->from('product_discount pd')
            ->leftJoin('discount d', 'd.id = pd.discount_id')
            ->leftJoin('product_shop ps', 'ps.product_id = pd.product_id')
            ->leftJoin('products p', 'p.id = pd.product_id')
            ->where('p.category_visible = 1 AND ps.shop_id = '.Yii::app()->shop->id.' AND DATE(NOW()) BETWEEN d.date_from AND d.date_to')
            ->queryColumn();


        $productIdString = implode(',',$productIds);

        if(!$productIdString){
            $productIdString = 'NULL';
        }

        $dataProvider = new CActiveDataProvider('Products', array(
            'criteria'=>array(
                'condition' => 'id IN ('.$productIdString.')'
            ),
            'pagination' => array(
                'pageVar'=>'page',
                'pageSize' => Yii::app()->shop->productCount->category,
            ),
        ));

        return $dataProvider;
    }
}