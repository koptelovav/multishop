<?php
/* @var $this ShopController */
/* @var $shop Shop */
/* @var $shopProductCount shopProductCount */
/* @var $shopImages ShopImages */
/* @var $shopEmailTemplate $shopEmailTemplate */
/* @var $form CActiveForm */

?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'shop-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal form-panel-submit'
        )
    )); ?>


    <?php echo $form->errorSummary(array($shop, $shopImages, $shopProductCount)); ?>


    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">Основные</a></li>
        <li><a href="#tab-data" data-toggle="tab">Данные</a></li>
        <li><a href="#tab-images" data-toggle="tab">Изображения</a></li>
        <li><a href="#tab-products-count" data-toggle="tab">Продукты</a></li>
        <li><a href="#tab-category" data-toggle="tab">Категории</a></li>
        <li><a href="#tab-email-template" data-toggle="tab">Шаблон email</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tab-general">
            <div class="form-group">
                <?php echo $form->labelEx($shop, 'domain', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'domain', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shop, 'domain'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'name', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'name', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shop, 'name'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'address', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textArea($shop, 'address', array('form-groups' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($shop, 'address'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'email', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'email', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shop, 'email'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'phone', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'phone', array('size' => 32, 'maxlength' => 32)); ?>
                    <?php echo $form->error($shop, 'phone'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab-data">
            <div class="form-group">
                <?php echo $form->labelEx($shop, 'title', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'title', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shop, 'title'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'meta_description', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textArea($shop, 'meta_description', array('class' => 'char-count', 'form-groups' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($shop, 'meta_description'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'meta_keywords', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textArea($shop, 'meta_keywords', array('class' => 'char-count', 'form-groups' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($shop, 'meta_keywords'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'template', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->dropDownList($shop, 'template', $shop->themes, array('empty' => '')); ?>
                    <?php echo $form->error($shop, 'template'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'default_product_id', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->dropDownList($shop, 'default_product_id', CHtml::listData($shop->products, 'id', 'short_title'), array('empty' => '')); ?>
                    <?php echo $form->error($shop, 'default_product_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'default_controller', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'default_controller', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shop, 'default_controller'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shop, 'vk_app_id', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'vk_app_id', array('size' => 60, 'maxlength' => 10)); ?>
                    <?php echo $form->error($shop, 'vk_app_id'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($shop, 'yandex_metrika_id', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shop, 'yandex_metrika_id', array('size' => 60, 'maxlength' => 10)); ?>
                    <?php echo $form->error($shop, 'yandex_metrika_id'); ?>
                </div>
            </div>

        </div>
        <div class="tab-pane" id="tab-images">

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'logo', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('backend.extensions.elFinder.ServerImageInput', array(
                            'value' => $shopImages->logo,
                            'name' => 'ShopImages[logo]',
                            'connectorRoute' => 'products/connector',
                        )
                    );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'icon', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('ext.elFinder.ServerImageInput', array(
                            'value' => $shopImages->icon,
                            'name' => 'ShopImages[icon]',
                            'connectorRoute' => 'products/connector',
                        )
                    );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'watermark', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('ext.elFinder.ServerImageInput', array(
                            'value' => $shopImages->watermark,
                            'name' => 'ShopImages[watermark]',
                            'connectorRoute' => 'products/connector',
                        )
                    );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'category_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'category_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'category_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'thumb_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'thumb_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'thumb_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'popup_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'popup_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'popup_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'product_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'product_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'product_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'additional_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'additional_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'additional_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'related_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'related_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'related_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'compare_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'compare_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'compare_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'wishlist_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'wishlist_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'wishlist_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'cart_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'cart_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'cart_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopImages, 'category_icon_width', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopImages, 'category_icon_width', array('size' => 10, 'maxlength' => 10)); ?>
                    X
                    <?php echo $form->textField($shopImages, 'category_icon_height', array('size' => 10, 'maxlength' => 10)); ?>
                </div>
            </div>


        </div>

        <div class="tab-pane" id="tab-products-count">
            <div class="form-group">
                <?php echo $form->labelEx($shopProductCount, 'index', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopProductCount, 'index', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopProductCount, 'index'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopProductCount, 'category', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopProductCount, 'category', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopProductCount, 'category'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopProductCount, 'hit_sales', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopProductCount, 'hit_sales', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopProductCount, 'hit_sales'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopProductCount, 'related', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopProductCount, 'related', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopProductCount, 'related'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopProductCount, 'new', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopProductCount, 'new', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopProductCount, 'new'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab-category">
            <div class="form-group">
                <?php echo CHtml::label('Категории', '', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <div class="scroll-box">
                        <?php echo CHtml::checkBoxList('Shop[categories]', CHtml::listData($shop->categories, 'id', 'id'), CHtml::listData(Category::model()->findAll(array(
                            'condition' => 'pid = :pid',
                            'params' => array(':pid' => Category::GENERAL_CATEGORY)
                        )), 'id', 'title'), array()); ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane" id="tab-email-template">
            <div class="form-group">
                <?php echo $form->labelEx($shopEmailTemplate, 'header_banner', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php
                    $this->widget('ext.elFinder.ServerImageInput', array(
                            'value' => $shopEmailTemplate->header_banner,
                            'name' => 'ShopEmailTemplate[header_banner]',
                            'connectorRoute' => 'products/connector',
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($shopEmailTemplate, 'color_1', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopEmailTemplate, 'color_1', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopEmailTemplate, 'color_1'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopEmailTemplate, 'color_2', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopEmailTemplate, 'color_2', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopEmailTemplate, 'color_2'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($shopEmailTemplate, 'color_3', array('class' => 'col-lg-3 control-label')); ?>
                <div class="col-lg-9">
                    <?php echo $form->textField($shopEmailTemplate, 'color_3', array('size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $form->error($shopEmailTemplate, 'color_3'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->