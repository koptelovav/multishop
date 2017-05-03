<div id="columns">
    <div id="category-list-view">
        <h1 class="category-title">Элементы конструктора Магформерс</h1>
        <div class="row products">
            <?php foreach (Piece::model()->findAll() as $piece):?>
                <?php $this->renderPartial('//products/_piece',array('data'=>$piece))?>
            <?php endforeach ?>
        </div>
    </div>
</div>