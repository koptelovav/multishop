<?php
class CategoryMenuWidget extends CWidget{
    public $options = array();
    public $subItems = true;
    public $categoryTitleField = 'title';

    public function run()
    {
        $this->render('view',array(
            'items' => $this->getCategoryItem(0),
            'options' => $this->options
        ));
    }

    protected function getCategoryItem($pid){
        $items = array();

        if($pid)
            $categories = Category::model()->findAllByAttributes(array('pid'=>$pid, 'visible'=>1));
        else
            $categories = Yii::app()->shop->categories;

        foreach ($categories as $category) {
            $itemOptions = array();
            if($this->subItems)
                $subItem = $this->getCategoryItem($category->id);
            else
                $subItem = array();

            if(!empty($subItem))
                $itemOptions['class'] = 'dropdown-submenu';
            $items[] = array(
                'label' => $category->{$this->categoryTitleField},
                'url' => array('/category/view', 'cid' => $category->id),
                'items' => $subItem,
                'itemOptions' => $itemOptions
            );
        }

        return $items;
    }
}