<?php
$this->pageTitle = 'Элементы конструктора магформерс';
?>

<div class="block block-color elements">
    <div class="block-title"><?php echo $this->pageTitle ?></div>
    <div class="block-content">
        <ul class="products">
            <?php foreach(Category::model()->findBypk(50)->products(array('scopes'=>array( 'sort' ))) as $key=>$product): ?>
                <?php $this->renderPartial('//products/_view', array('index'=>$key, 'data'=>$product))?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>