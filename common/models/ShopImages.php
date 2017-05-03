<?php

/**
 * This is the model class for table "shop_images".
 *
 * The followings are the available columns in table 'shop_images':
 * @property string $id
 * @property string $logo
 * @property string $icon
 * @property string $category_width
 * @property string $category_height
 * @property string $thumb_width
 * @property string $thumb_height
 * @property string $popup_width
 * @property string $popup_height
 * @property string $product_width
 * @property string $product_height
 * @property string $additional_width
 * @property string $additional_height
 * @property string $related_width
 * @property string $related_height
 * @property string $compare_width
 * @property string $compare_height
 * @property string $wishlist_width
 * @property string $wishlist_height
 * @property string $cart_width
 * @property integer $cart_height
 * @property integer category_icon_width
 * @property integer category_icon_height
 */
class ShopImages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopImages the static model class
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
		return 'shop_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cart_height', 'numerical', 'integerOnly'=>true),
			array('watermark, logo, icon', 'length', 'max'=>128),
			array('category_icon_width, category_icon_height, category_width, category_height, thumb_width, thumb_height, popup_width, popup_height, product_width, product_height, additional_width, additional_height, related_width, related_height, compare_width, compare_height, wishlist_width, wishlist_height, cart_width', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, logo, icon, category_width, category_height, thumb_width, thumb_height, popup_width, popup_height, product_width, product_height, additional_width, additional_height, related_width, related_height, compare_width, compare_height, wishlist_width, wishlist_height, cart_width, cart_height', 'safe', 'on'=>'search'),
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
			'logo' => 'Logo',
			'icon' => 'Icon',
            'watermark'=> 'Watermark',
			'category_width' => 'Category Width',
			'category_height' => 'Category Height',
			'thumb_width' => 'Thumb Width',
			'thumb_height' => 'Thumb Height',
			'popup_width' => 'Popup Width',
			'popup_height' => 'Popup Height',
			'product_width' => 'Product Width',
			'product_height' => 'Product Height',
			'additional_width' => 'Additional Width',
			'additional_height' => 'Additional Height',
			'related_width' => 'Related Width',
			'related_height' => 'Related Height',
			'compare_width' => 'Compare Width',
			'compare_height' => 'Compare Height',
			'wishlist_width' => 'Wishlist Width',
			'wishlist_height' => 'Wishlist Height',
			'cart_width' => 'Cart Width',
			'cart_height' => 'Cart Height',
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
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('category_width',$this->category_width,true);
		$criteria->compare('category_height',$this->category_height,true);
		$criteria->compare('thumb_width',$this->thumb_width,true);
		$criteria->compare('thumb_height',$this->thumb_height,true);
		$criteria->compare('popup_width',$this->popup_width,true);
		$criteria->compare('popup_height',$this->popup_height,true);
		$criteria->compare('product_width',$this->product_width,true);
		$criteria->compare('product_height',$this->product_height,true);
		$criteria->compare('additional_width',$this->additional_width,true);
		$criteria->compare('additional_height',$this->additional_height,true);
		$criteria->compare('related_width',$this->related_width,true);
		$criteria->compare('related_height',$this->related_height,true);
		$criteria->compare('compare_width',$this->compare_width,true);
		$criteria->compare('compare_height',$this->compare_height,true);
		$criteria->compare('wishlist_width',$this->wishlist_width,true);
		$criteria->compare('wishlist_height',$this->wishlist_height,true);
		$criteria->compare('cart_width',$this->cart_width,true);
		$criteria->compare('cart_height',$this->cart_height);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}