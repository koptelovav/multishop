<div class="row products">
    <?php foreach(Category::model()->findByPk(99)->products(array('scopes'=>array('sort'))) as $key=>$product): ?>
        <?php $this->renderPartial('//products/_view', array('data'=>$product)) ?>
    <?php endforeach; ?>
</div>
