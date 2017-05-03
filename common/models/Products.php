<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property string $id
 * @property string shop
 * @property string $category
 * @property string $short_title
 * @property string $title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $description
 * @property string $image
 * @property string $type
 * @property string $price
 * @property string shipping_discount
 * @property string $amount
 * @property string $manufacturer_id
 * @property string $active
 * @property string $in_stock
 * @property string $sort
 * @property string $currentPrice
 * @property string $updated
 * @property Images[] $images
 * @property Discount $discount
 * @property ProductComposition[] compositions
 * @property Attribute[] product_attributes
 */
class Products extends CActiveRecord
{
    const TYPE_SIMPLE = 'simple';
    const TYPE_SET = 'set';
    const TYPE_PRODUCT_SET = 'product_set';
    const TYPE_COMPOSITION = 'composition';

    public $shop;
    public $credits;
    public $article;
    public $weight;
    public $code;
    public $unit;
    public $detail_number;
    public $box_size;
    public $barcode;
    public $video;
    public $user_weight;
    public $disc_size;
    public $saks_update;
    public $qixels_cube_count;

    public $base_price = false;
    public $price_prefix = false;

    public function behaviors(){
        return array(
            'ImageBehavior' => array(
                'class' => 'common.behaviors.ImageBehavior'
            ),
            'ESaveRelatedBehavior' => array(
                'class' => 'common.behaviors.ESaveRelatedBehavior'
            ),
            'SSortableBehavior' => array(
                'class' => 'backend.extensions.SSortableBehavior.SSortableBehavior',
                'categoryField' => 'category'
            ),
        );
    }

    public function defaultScope()
    {
        return array(
            'condition'=>"active=1",
        );
    }

    public function scopes() {
        return array(
            'currentShop' => array(
                'condition' => 'category = "'.Yii::app()->params['category'].'"'
            ),
            'sort'=> array(
                'order' => 'in_stock DESC, sort ASC'
            ),
            'in_category' => array(
                'condition' => 'category_visible = 1',
                'order' => 'in_stock DESC, sort ASC'
            )
        );
    }

    public function visible($list)
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN `product_visible` ON `product_id` = `id`';
        $criteria->condition = ':list = 1';
        $criteria->params = array(':list'=>$list);

        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Products the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'products';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('short_title, title,', 'required'),
            array('type, active, in_stock, category_visible, shop, description, meta_description, meta_keywords,updated', 'safe'),
            array('short_title, title, image', 'length', 'max' => 254),
            array('slug', 'length', 'max' => 128),
            array('shipping_discount, category, shop, price, amount, manufacturer_id, sort', 'length', 'max' => 10),
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
            'descriptions' => array(self::HAS_MANY, 'ProductDescription', 'product_id'),
            'imagesCount' => array(self::STAT, 'Image', 'product_id'),
            'manufacturer' => array(self::BELONGS_TO, 'Manufacturer', 'manufacturer_id'),
            'generalShop' => array(self::BELONGS_TO, 'Shop', 'shop'),
            'generalCategory' => array(self::BELONGS_TO, 'Category', 'category'),
            'features' =>  array(self::HAS_MANY, 'ProductFeature', 'product_id'),
            'pieces'=>array(self::MANY_MANY, 'Piece',
                'product_piece(product_id, piece_id)'),
            'product_attributes'=>array(self::MANY_MANY, 'Attribute',
                'product_attribute(product_id, attribute_id)'),
            'discount' => array(self::MANY_MANY, 'Discount',
                'product_discount(product_id, discount_id)',
            ),
            'meta' => array(self::BELONGS_TO, 'ProductMeta', 'product_id'),
            'categories'=>array(self::MANY_MANY, 'Category',
                'product_category(product_id, category_id)'),
            'news'=>array(self::MANY_MANY, 'News',
                'product_news(product_id, news_id)'),
            'related'=>array(self::MANY_MANY, 'Products',
                'related_product(product_id, related_id)'),
            'include'=>array(self::MANY_MANY, 'Products',
                'product_include(product_id, include_id)'),
            'shops'=>array(self::MANY_MANY, 'Shop',
                'product_shop(product_id, shop_id)'),
            'gifts'=>array(self::MANY_MANY, 'Products',
                'product_gift(product_id, gift_id)'),
            'attachments'=>array(self::MANY_MANY, 'Attachment',
                'product_attachment(product_id, attachment_id)'),
            'certificates'=>array(self::MANY_MANY, 'Attachment', 'product_attachment(product_id, attachment_id)',
                'condition' => 'certificates.type = :type',
                'params' => array(':type' => Attachment::TYPE_CERTIFICATE)
            ),
            'compositions' => array(self::HAS_MANY, 'ProductComposition', 'product_id', 'with'=>'product'),
            'compositionsProduct' => array(self::MANY_MANY, 'Products', 'product_composition(product_id,include_id)'),
            'productIncludePrice' =>array(self::STAT, 'Products',
                'product_include(product_id, include_id)','select'=> 'SUM(IFNULL(custom_price, price)*product_include.count)',),
            'product_include' => array(self::HAS_MANY, 'ProductInclude', 'product_id'),
            'product_piece' => array(self::HAS_MANY, 'ProductPiece', 'product_id'),
            'product_gift' => array(self::HAS_MANY, 'ProductGift', 'product_id'),
            'productIncludeCount' => array(self::STAT, 'ProductInclude', 'product_id', 'select' => 'SUM(count)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'in_stock' => 'В наличии',
            'active'=> 'Активен',
            'shop'=>'Главный магазин',
            'category' => 'Главная категория',
            'short_title' => 'Короткое название',
            'title' => 'Название',
            'description' => 'Описание',
            'meta_description' => 'Мета-тег "Описание',
            'meta_keywords' => 'Мета-тег "Ключевые слова"',
            'image' => 'Изображение',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'article' => 'Артикул',
            'sort' => 'Сортировка',
            'manufacturer_id' => 'Производитель',
            'slug' => 'SEO ссылка',
            'credits' => 'Баллы',
            'shipping_discount'=> 'скидка на доставку'
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title',  $this->short_title, true);
        $criteria->compare('title', $this->short_title, true);
        $criteria->compare('description', $this->description);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('price', $this->price, true);
        $criteria->join = 'LEFT JOIN product_composition pc ON pc.include_id = id';
        $criteria->addCondition('pc.product_id is NULL');
        if($this->category){
            $sql = 'SELECT id FROM category WHERE pid = ' .$this->category;
            $categoryChilds = Yii::app()->db->createCommand($sql)->queryAll();
            if($categoryChilds){
                $inConditionArray = array();
                foreach ($categoryChilds as $child) {
                    $inConditionArray[] = $child['id'];
                }
                $inConditionArray[] = $this->category;

                $criteria->addInCondition('category',$inConditionArray);
            }else{
                $criteria->compare('category', $this->category);
            }
        }

        $criteria->order = 'sort ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    /**
     * @return Discount
     */
    public function getDiscount(){
        $discounts = $this->discount(array('scopes'=>'actual'));
        if(!empty($discounts))
            return $discounts[0];
        return false;
    }

    public function isDiscount(){
        $discounts = $this->discount(array('scopes'=>'actual'));
        return count($discounts);
    }

    public function getPrice(){
        $price = $this->price ? $this->price : $this->productIncludePrice;
        /*if($productAttributes = $this->product_attributes){
            $attributeMinValues = array();
            foreach ($productAttributes as $productAttribute)
                foreach($productAttribute->attribute_values as $value)
                    if(!isset($attributeMinValues[$productAttribute->id]) || $attributeMinValues[$productAttribute->id] > $value->mark_up)
                        $attributeMinValues[$productAttribute->id] = $value->mark_up;
            foreach ($attributeMinValues as $markUp) {
                $price += $markUp;
                if($markUp > 0)
                    $this->price_prefix = true;
            }
        }*/
        return $price;
    }

    public function getCurrentPrice(){
        $price = $this->getPrice();
        if($discount = $this->getDiscount()){
            if(strpos($discount->value,'%') !== false){
                $price = $price - floor($price*$discount->value/100);
            }else{
                $price = $price - $discount->value;
            }
        }

        return $price;
    }

    public function getPotentialRelatedProduct(){
        /* @var $command CDbCommand */
        if(!$this->isNewRecord){
            $sql = '
            SELECT p.*
            FROM products p
            LEFT JOIN product_shop ps ON p.id = ps.product_id
            WHERE ps.shop_id IN (SELECT ps.shop_id FROM products p LEFT JOIN product_shop ps ON p.id = ps.product_id WHERE p.id = '.$this->id.')';
            $productIds = Yii::app()->db->createCommand($sql)->queryAll();

            return self::model()->populateRecords($productIds);
        }
        return array();
    }

    public function getCategoryList(){
        $categoryArray = array();
        foreach($this->categories as $category){
            $categoryArray[] = CHtml::link($category->title,array('category/view','cid'=>$category->id));
        }

        if(is_array($categoryArray))
            return implode(',',$categoryArray);
        else
            return false;
    }

    public function getDescription(){
        $customDescription = ProductDescription::model()->findByAttributes(array(
            'shop_id' => Yii::app()->shop->id,
            'product_id' => $this->id,
        ));
        if($customDescription)
            return $customDescription->description;
        return $this->description;
    }

    public function delete(){
        $this->active = 0;
        $this->save();
    }

    public function afterFind(){
        $this->credits = $this->price * Yii::app()->globalSettings->credits_ratio;
        foreach ($this->features as $feature) {
            $featureName = $feature->feature->name;
            $this->{$featureName} = $feature->value;
        }

        $this->base_price = $this->price ? $this->price : $this->productIncludePrice;
    }

    public function is($meta){
       $value = Yii::app()->db->createCommand()
           ->select('value')
           ->from('product_meta')
           ->where('product_id='.$this->id.' AND meta="'.$meta.'"')
           ->queryScalar();
       return $value;
    }

    public function aggregateOfferData()
    {
        $composition = $this->compositions;
        $result = array(
            'offerCount' => count($composition),
            'lowPrice' => null,
            'highPrice' => null,
        );
        foreach($composition as $compositionProduct){
            $price = $compositionProduct->product->getCurrentPrice();
            if(is_null($result['lowPrice']) || $result['lowPrice'] > $price)
                $result['lowPrice'] = $price;
            if(is_null($result['highPrice']) || $result['highPrice'] < $price)
                $result['highPrice'] = $price;
        }

        return $result;
    }

    public static function getTree(){
        $result = array();
        /*foreach(Shop::model()->findAll() as $shop){
            if(!isset($result[$shop->name]))
                $result[$shop->name] = array();
            $result[$shop->name] = CHtml::listData($shop->products, 'id','short_title');
        }
*/
        return $result;
    }

    public function getVideoUrl($autoPlay = 1)
    {
        if(strpos($this->video, 'youtube') !== false){
            if(preg_match('/watch\?v=([A-za-z0-9\-_]*)/', $this->video, $matches)){
                $videoId = $matches[1];
            }
        }

        if(isset($videoId)){
            $url = '//www.youtube.com/embed/'.$videoId . ($autoPlay ? '?autoplay=1' : '');
            return $url;
        }


        return $this->video;
    }

    public function getAttributeString()
    {
        $data = Yii::app()->db->createCommand()
            ->select('pf.value')
            ->from('product_filter pf')
            ->where('pf.product_id = '.$this->id)
            ->queryColumn();

        $filter_string = 'data-id="'.$this->id.'" data-filter="'.implode(',',$data).'" data-price="'.$this->currentPrice.'"';

        return $filter_string;
    }

    public function beforeSave()
    {
        $this->updated = null;
        return true;
    }
}