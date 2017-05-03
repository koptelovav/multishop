<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 29.07.13
 * Time: 11:59
 * To change this template use File | Settings | File Templates.
 */

class Cart extends CApplicationComponent{

    public $productModel;
    public $priceField;


    public function setClientData($data){
        $this->modifyCart('client_data',$data);
    }

    public function getClientData(){
        $result = array();
        if(isset(Yii::app()->session['client_data'])){
            foreach( Yii::app()->session['client_data'] as $key=>$value){
                if($value)
                    $result[$key]=$value;
            }
        }
        return $result;
    }

    public function getProducts(){
        if(isset(Yii::app()->session['products']))
            return Yii::app()->session['products'];
        return array();
    }

    public function setShipping($shipping){
        $this->modifyCart('shipping',$shipping);
    }

    public function shipping(){
        return Yii::app()->session['shipping'];
    }

    public function getTo(){
        return  Yii::app()->session['shipping']['to'];
    }
    public function resetShipping(){
        unset(Yii::app()->session['shipping']);
    }

    public function add($product, $attributes = array()){
        $this->addToSession($product, 1, $attributes);
    }

    public function sub($product){
        $this->addToSession($product, -1);
    }

    public function delete($id){
        $this->deleteFromSession($id);
    }

    public function total($param = '', $withShipping = false)
    {
        $total = array();
        $total['count'] = 0;
        $total['price'] = 0;
        $total['weight'] = 0;

        foreach ($this->getProducts() as $id=>$count) {
            $product = CActiveRecord::model($this->productModel)->findByPk((int)$id);
            $total['count'] = $total['count'] + $count;
            $total['price'] = $total['price'] + $count * $product->{$this->priceField};
            $total['weight'] = $total['weight'] + $count * ($product->weight ? $product->weight : 300);
        }

        if($withShipping && isset(Yii::app()->session['shipping']))
            $total['price'] += Yii::app()->session['shipping']['price'];

        if(!empty($param) && isset($total[$param]))
            return $total[$param];
        return $total;
    }

    public function clear(){
        $this->modifyCart('products',array());
    }

    protected function addToSession($product, $count, $attributes = array()){
        $clientData = Yii::app()->session['client_data'];
        $productHash = $product->id;
        $attributeString = '';
        $markUp = 0;
        foreach ($attributes as $item){
            $attributeValue = AttributeValue::model()->findByPk($item);

            $productHash = $productHash.'_'.$item;

            $attributeString .= $attributeValue->attribute->title.': '.$attributeValue->value.'; ';
            $markUp += $attributeValue->mark_up;
        }



        if(isset($clientData['products'][$productHash])){
            if($clientData['products'][$productHash]['count'] + $count > 0)
                $clientData['products'][$productHash]['count'] += $count;
        }
        else{
            $clientData['products'][$productHash] = array(
                'id' => $product->id,
                'title' => $product->short_title,
                'image' => $product->image,
                'price' =>  $product->currentPrice,
                'count' => $count,
                'weight' => $product->weight,
                'discount' => (boolean)$product->getDiscount(),
                'shipping_discount' => $product->shipping_discount,
                'attributeString' => $attributeString,
                'attributes' => $attributes
            );
        }
         var_export($clientData['products']);

        $this->modifyCart('client_data',$clientData);
    }

    protected function deleteFromSession($id){
        $products = $this->getProducts();
        unset($products[$id]);
        $this->modifyCart('products',$products);
    }

    public function getLastModified(){
        return isset(Yii::app()->session['last_modified']) ? Yii::app()->session['last_modified'] : date('Y-m-d H:i:s');
    }

    protected function setLastModified($date = null)
    {
        Yii::app()->session['last_modified'] = is_null($date) ? 0 : $date;
    }

    public function modifyCart($key, $value){
        Yii::app()->session[$key] = $value;
        $this->setLastModified();
    }

    /*Static Methods*/

    public static function buyButton($product, $label="В корзину", $class='', $onclick =false){
        $id = is_object($product) ? $product->id : $product;

        if(!$product->in_stock)
            return '<a class="buy btn no-stock-btn">Нет в наличии</a>';

        $data = [
            'data-href' => Yii::app()->createUrl('cart/add'),
            'data-id' => $id,
            'data-modificator'=>'cart',
            'data-event'=>'buy_product',
            'data-preloader'=>'enable',
            'class' => 'buy '.$class
        ];

        if($onclick){
            $data['onclick'] = $onclick;
        }

        return CHtml::link($label, '#',$data);
    }

    public static function countHtml(){
        return '<span class="shopping-cart-count" data-object="cart"></span>';
    }
}