<?php if($attachments = $product->attachments): ?>
    <h4>Вложения</h4>
    <div id="attachments">
        <?php foreach ($attachments as $item){
            echo CHtml::link($item->title, $item->url, array('target'=>'_blank')).'<br/>';
        }
        ?>
    </div>
<?php endif;?>