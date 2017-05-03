<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property string $id
 * @property string $pid
 * @property string $title
 * @property string $description
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $icon
 * @property string $sort
 */
class Category extends CActiveRecord
{
    const GENERAL_CATEGORY = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'category';
	}

    public function defaultScope()
    {
        return array(
            'order'=>"sort",
            'condition'=>"visible=1",
        );
    }

    public function behaviors(){
        return array(
            'ImageBehavior' => array(
                'class' => 'common.behaviors.ImageBehavior'
            )
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
			array('short_title, title', 'required'),
            array('static_page, visible, title, description, meta_description, meta_keywords, icon', 'safe'),
			array('shop_id, pid, sort', 'length', 'max'=>10),
			array('title, icon', 'length', 'max'=>128),
            array('second_title', 'length', 'max'=>1024),
			array('meta_keywords', 'length', 'max'=>500),
            array('slug', 'length', 'max' => 64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, title, description, meta_description, meta_keywords, icon, sort', 'safe', 'on'=>'search'),
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
            'parent' => array(self::BELONGS_TO, 'Category', 'pid'),
            'products' => array(self::MANY_MANY, 'Products','product_category(category_id,product_id)'),
            'children' => array(self::HAS_MANY, 'Category', 'pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shop_id' => 'Магазин',
			'pid' => 'Родительская категория',
            'short_title' => 'Короткое название',
			'title' => 'Название',
			'description' => 'Описание',
            'meta_description' => 'Мета-тег "Описание',
            'meta_keywords' => 'Мета-тег "Ключевые слова"',
			'icon' => 'Изображение',
			'sort' => 'Сортировка',
            'slug' => 'SEO ссылка',
			'visible' => 'Активна',
			'static_page' => 'Статичная страница'
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
		$criteria->compare('pid',$this->pid,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('sort',$this->sort,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getSlug($cid, $nesting = 0)
    {
        $slug = array();
        $category = Category::model()->findByPk($cid);

        if (!is_object($category))
            return array();

        if($category->pid != 0){
            if(Yii::app()->shop->category_nesting > $nesting){
                $nesting++;
                $slug = $this->getSlug($category->pid, $nesting);
            }
        }

        $slug[] = $category->slug;

        return $slug;
    }

    public function existProduct($id){
        return Yii::app()->db->createCommand()
            ->select('COUNT(*)')
            ->from('product_category')
            ->where('product_id='.$id.' AND category_id='.$this->id)
            ->queryScalar();
    }

	public static function getAllProductsIds($category_id, $filter = array(), $child = true)
	{
		$product = array(
		    'all'=>array(),
            'child'=>array()
        );

		$categoryChild = Yii::app()->db->createCommand()
			->select('id')
			->from('category')
			->where('pid = :pid AND visible = 1', array(':pid'=>$category_id))
            ->order('sort')
			->queryAll();

        if($child){
            foreach($categoryChild as $childId){
                $childProductIds = self::getAllProductsIds($childId['id'], $filter);
                $product['child'][$childId['id']] = $childProductIds['all'];
                $product['all'] = array_merge($product['all'], $childProductIds['all']);
            }
        }

		$productCommand = Yii::app()->db->createCommand()
			->select('p.id')
			->from('products p')
			->join('product_category pc', 'pc.product_id=p.id')
			->where('category_id = :category_id AND active = 1 AND category_visible = 1', array(':category_id'=>$category_id))
			->group('p.id');


		if(!empty($filter)){
			if(isset($filter['min_price']) && isset($filter['max_price']))
				$productCommand->andWhere('p.price BETWEEN :min_price AND :max_price', array(':min_price' => $filter['min_price'], ':max_price' => $filter['max_price']));

			if(isset($filter['brand']))
				$productCommand->andWhere(array('in', 'p.manufacturer_id', $filter['brand']));


			if(isset($filter['age'])){
				$productCommand->join('product_filter pf_a', 'pf_a.product_id=p.id');
				$productCommand->andWhere(array('in', 'pf_a.value', $filter['age']));
			}

			if(isset($filter['gender'])){
                $productCommand->join('product_filter pf_g', 'pf_g.product_id=p.id');
                $productCommand->andWhere(array('in', 'pf_g.value', $filter['gender']));
            }

            if(isset($filter['size'])){
                $productCommand->join('product_filter pf_s', 'pf_s.product_id=p.id');
                $productCommand->andWhere(array('in', 'pf_s.value', $filter['size']));
            }

            if(isset($filter['level'])){
                $productCommand->join('product_filter pf_l', 'pf_l.product_id=p.id');
                $productCommand->andWhere(array('in', 'pf_l.value', $filter['level']));
            }

            if(isset($filter['magformers_tags'])){
                $productCommand->join('product_filter pf_t', 'pf_t.product_id=p.id');
                $productCommand->andWhere(array('in', 'pf_t.value', $filter['magformers_tags']));
            }
		}
        $productCommand->order('p.in_stock DESC');

		$categoryProduct = $productCommand->queryColumn();
        $product['all'] = array_merge($product['all'], $categoryProduct);
		return $product;
	}

	public static function getFilter($ids)
	{
		if(is_array($ids))
			$ids = implode(',',$ids);

		$sql = 'SELECT MIN(price) as min_price, MAX(price) as max_price FROM products p WHERE id IN ('.$ids.')';
		$price = Yii::app()->db->createCommand($sql)->queryRow();
		$filer['min_price'] = $price['min_price'];
		$filer['max_price'] = $price['max_price'];

		$sql = 'SELECT fv.id, fv.value FROM product_filter pf LEFT JOIN filter_value fv ON pf.value = fv.id WHERE product_id IN ('.$ids.') AND pf.filter_id = '.Filter::AGE.' GROUP BY pf.value ORDER BY fv.sort';
		$age = Yii::app()->db->createCommand($sql)->queryAll();
		$filer['age'] = $age;

		$sql = 'SELECT fv.id, fv.value FROM product_filter pf LEFT JOIN filter_value fv ON pf.value = fv.id WHERE product_id IN ('.$ids.') AND pf.filter_id = '.Filter::GENDER.' GROUP BY pf.value ORDER BY fv.sort';
		$gender = Yii::app()->db->createCommand($sql)->queryAll();
		$filer['gender'] = $gender;

        $sql = 'SELECT fv.id, fv.value FROM product_filter pf LEFT JOIN filter_value fv ON pf.value = fv.id WHERE product_id IN ('.$ids.') AND pf.filter_id = '.Filter::SIZE.' GROUP BY pf.value ORDER BY fv.sort';
        $size = Yii::app()->db->createCommand($sql)->queryAll();
        $filer['size'] = $size;

        $sql = 'SELECT fv.id, fv.value FROM product_filter pf LEFT JOIN filter_value fv ON pf.value = fv.id WHERE product_id IN ('.$ids.') AND pf.filter_id = '.Filter::MAGFORMERS_TAG.' GROUP BY pf.value ORDER BY fv.sort';
        $magformersTags = Yii::app()->db->createCommand($sql)->queryAll();
        $filer['magformers_tags'] = $magformersTags;

        $sql = 'SELECT fv.id, fv.value FROM product_filter pf LEFT JOIN filter_value fv ON pf.value = fv.id WHERE product_id IN ('.$ids.') AND pf.filter_id = '.Filter::LEVEL.' GROUP BY pf.value ORDER BY fv.sort';
        $level = Yii::app()->db->createCommand($sql)->queryAll();
        $filer['level'] = $level;

		$sql = 'SELECT m.id, m.name FROM products p LEFT JOIN manufacturer m ON m.id = p.manufacturer_id WHERE p.id IN ('.$ids.') GROUP BY m.id';
		$brand = Yii::app()->db->createCommand($sql)->queryAll();
		$filer['brand'] = $brand;
		
		return $filer;
	}

	public function getStaticPages()
	{
		$result = array();
		$files = CFileHelper::findFiles(Yii::getPathOfAlias("frontend.views.static_category"));
		$files = str_ireplace(array(Yii::getPathOfAlias("frontend.views.static_category").DIRECTORY_SEPARATOR, '.php'), '', $files);
		foreach($files as $item)
			$result[$item] = $item;
		return $result;
	}
}