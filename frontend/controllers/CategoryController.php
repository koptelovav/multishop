<?php
class CategoryController extends FrontEndController
{
    public $filter = array();
    /**
     * @param $cid
     */

    public function actionMagformersView()
    {
        $category = Category::model()->findByPk(32);
        $this->pageTitle = $category->title;

            $productIds = Category::getAllProductsIds($category->id, Yii::app()->request->getParam('filter'));
            $this->filter = Category::getFilter(Category::getAllProductsIds($category->id)['all']);

        $this->render('view', array(
            'categories' => $productIds['child'],
        ));

    }

    public function actionView($cid)
    {
        $category = Category::model()->findByPk($cid);
        $child = $cid != 32;
        $this->pageTitle = $category->title;


        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag($category->meta_keywords, 'keywords');
        $cs->registerMetaTag($category->meta_description, 'description');
        $cs->registerMetaTag($category->title,null,null,array('property'=>'og:title'));
        $cs->registerMetaTag(Yii::app()->createAbsoluteUrl('category/view', array('cid'=>$category->id)),null,null,array('property'=>'og:url'));
        $cs->registerMetaTag($category->meta_description,null,null,array('property'=>'og:description'));
        $cs->registerMetaTag(Yii::app()->image->createUrl( 'thumbnail', Yii::app()->media->webroot.$category->icon),null,null,array('property'=>'og:image'));
        $cs->registerLinkTag(null, null, Yii::app()->createAbsoluteUrl('category/view', array('cid'=>$category->id)), null, array('rel' => 'canonical'));

        if(!$category->static_page){
            $productIds = Category::getAllProductsIds($category->id, Yii::app()->request->getParam('filter'), $child);
            $this->filter = Category::getFilter(Category::getAllProductsIds($category->id)['all']);


            $productIdString = implode(',',$productIds['all']);

            if(!$productIdString){
                $productIdString = 'NULL';
            }

            /*****************SORT******************/


            $sort = new CSort;
//            $sort->multiSort = true;
            $sort->attributes = array(
                'price'=>array(
                    'asc'=>'price',
                    'desc'=>'price DESC',
                    'label'=>'цене',
                ),
                'title'=>array(
                    'asc'=>'title',
                    'desc'=>'title DESC',
                    'label'=>'названию',
                ),
                'sort'=>array(
                    'asc'=>'sort',
                    'desc'=>'sort DESC',
                'label'=>'популярности',
                ),
                'in_stock'=>array(
                'asc'=>'in_stock',
                'desc'=>'in_stock DESC',
                'label'=>'наличию',
            )
            );
            $sort->defaultOrder = array(
                'in_stock'=>CSort::SORT_DESC,
                'sort'=>CSort::SORT_ASC,
            );

            $dataProvider = new CActiveDataProvider('Products', array(
                'criteria'=>array(
                    'condition' => 'id IN ('.$productIdString.')'
                ),
                'pagination' => array(
                    'pageVar'=>'page',
                    'pageSize' => Yii::app()->shop->productCount->category,
                ),
                'sort' => $sort
            ));


            $this->render('view', array(
                'categories' => $productIds['child'],
                'category' => $category,
                'dataProvider' => $dataProvider,
            ));
        }
        else{
            $this->render('//static_category/'.$category->static_page, array(
                'category' => $category
            ));
        }

    }
}