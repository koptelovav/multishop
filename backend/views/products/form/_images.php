<div class="row">
    <div class="col-lg-6">
        <?php
        $this->widget('backend.extensions.elFinder.ElFinderBrowserWidget', array(
                'connectorRoute' => 'image/connector',
            )
        );
        ?>
    </div>


    <div id="file-form" class="col-lg-6">
        <div id="images-browser">

        </div>
        <h3>Загруженные</h3>
        <?php foreach ($model->getAllImages() as $index => $image): ?>
            <? $index += 10000; ?>
            <div class="item">
                <img class="product-image" data-num="n<?= $index ?>" height="120px" src="<?php echo  Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot.$image->url) ?>" alt=""/>

                <div class="hidden-info" data-num="n<?= $index ?>">
                    <input data-num="n<?= $index ?>" name="Images[<?=$index?>][url]" type="hidden" value="<?php echo $image->url?>"/>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Размещение</label>
                        <div class="col-lg-10">
                            <select data-num="n<?= $index ?>" name="Images[<?=$index?>][type]">
                                <option value="2">Дополнительное</option>
                                <option value="1" <?= $image->type == Image::TYPE_GENERAL ? 'selected="selected"': ''?>>Основное</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Alt</label>
                        <div class="col-lg-10">
                            <input data-num="n<?= $index ?>" name="Images[<?=$index?>][alt]" value="<?php echo $image->alt ?>" type="text" size="60">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input data-num="n<?= $index ?>" name="Images[<?=$index?>][title]" value="<?php echo $image->title ?>" type="text" size="60">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Описание</label>
                        <div class="col-lg-10">
                            <textarea data-num="n<?= $index ?>" name="Images[<?=$index?>][description]" cols="60" rows="5"><?php echo $image->description ?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <a class="delete-product-image" href="#">Удалить изображение</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>