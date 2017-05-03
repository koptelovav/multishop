<?php

class CategoryController extends BackEndController
{
    public $pageTitle = 'Категории';
    public $controllerModelName = 'Category';
    public function actionIndex()
    {
        $this->buttonCurrentTemplate = $this->buttonIndexTemplate;
        $shopId = $_GET['shop_id'] ? $_GET['shop_id'] : Shop::model()->find()->id;
        $items  = $this->getCategoryItem(0, $shopId);
        $this->render('index',array(
            'shopId' =>$shopId,
            'items'=>$items,
        ));
    }

    protected function form($model){
        if(isset($_POST[$this->controllerModelName]))
        {
            $model->attributes=$_POST[$this->controllerModelName];
            if($model->save())
                $this->redirect(array('index', 'shop_id'=>$model->shop_id));
        }

        $this->render('form',array(
            'model'=>$model,
        ));
    }

    protected function getCategoryItem($pid,$shopId){
        $items = array();
        $categories = Category::model()->findAllByAttributes(array('shop_id'=>$shopId,'pid'=>$pid, 'visible'=>1), array('order' => 'sort ASC'));

        foreach ($categories as $category) {
            $itemOptions = array();
            $subItem = $this->getCategoryItem($category->id,$shopId);

            if(!empty($subItem))
                $itemOptions['class'] = 'subcategory';
            $items[] = array(
                'label' => $category->title. '<span> '. $category->id.' - '. $category->sort.'</span>',
                'url' => array('/category/update', 'id' => $category->id),
                'items' => $subItem,
                'itemOptions' => $itemOptions
            );
        }

        return $items;
    }
}