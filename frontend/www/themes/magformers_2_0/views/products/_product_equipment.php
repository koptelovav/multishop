<?php if($gifts = $product->gifts): ?>
    <h2>Подарки:</h2>
    <ul class="include-product list-unstyled">
        <?php foreach($gifts as $item): ?>
            <li><?= CHtml::link($item->title, PHtml::url($item)) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if($pieces = $product->product_piece): ?>
    <h2>Комплектация набора:</h2>
    <ul class="include-pieces">
        <?php foreach($pieces as $item): ?>
            <?php
            $piece = $item->piece;
            $itemPropContentUrl = Yii::app()->imageApi->createUrl(PHtml::IMAGE_PIECE, Yii::app()->media->webroot . $piece->preview_image);
            $image = CHtml::image($itemPropContentUrl, $piece->title, array('class'=>'img-responsive'));
            ?>
            <li>
                <?= CHtml::link($image, Yii::app()->createUrl('piece/view', array('id'=>$piece->id))) ?>
                <span class="item-count-wr">
                    <span class="item-count"><?= $item->piece_count ?></span>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>