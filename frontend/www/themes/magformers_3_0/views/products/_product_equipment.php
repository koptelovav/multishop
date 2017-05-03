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
            $imageData = realpath(Yii::app()->media->basePath.'/www'.$piece->preview_image) ?  Yii::app()->imageApi->createUrl(PHtml::IMAGE_PIECE, Yii::app()->media->webroot . $piece->preview_image) : $piece->temp_image;
            $itemPropContentUrl = Yii::app()->imageApi->createUrl(PHtml::IMAGE_PIECE, Yii::app()->media->webroot . $imageData);
            $image = CHtml::image($imageData, $piece->title, array('class'=>'img-responsive'));
            ?>
            <li class="include-pieces--item">
                <span class="include-pieces--item--inside">
                    <?= CHtml::link($image, Yii::app()->createUrl('piece/view', array('id'=>$piece->id))) ?>
                    <span class="item-count-wr">
                        <span class="item-count"><?= $item->piece_count ?></span>
                    </span>
                    <span class="include-pieces--item--title">
                        <?= $piece->title?>
                    </span>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>