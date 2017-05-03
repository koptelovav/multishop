<?php if ($product->video): ?>
    <div id="video-review" class="video-container">
        <?php echo SHtml::video($product->video) ?>
    </div>
<?php endif; ?>