<?php
$this->pageTitle = 'Контакты';
?>

<div class="static-page">
    <h1>Контакты</h1>
    <div class="static-page-content">
    <div class="row">
        <div class="col-lg-5">
            <div itemscope itemtype="http://schema.org/LocalBusiness">
            <div class="row simple-text">
                <div class="col-lg-12">
                <?php /*    <p><span style="font-weight: bold">График работы магазина в торговом центре</span><br/>
                        Ежедневно с 10:00 до 22:00 / Перерыв с 14:00 - 15:00</span></p>
*/ ?>
                    <p><span
                            style="font-weight: bold">График работы интернет-магазина (консультация по заказу/товарам)</span><br/>
                        <time itemprop="openingHours" datetime="Mo-Fr 10:00−18:00">ПН-ПТ с 10:00 до 20:00 | CБ-ВС выходной</time></p>

                    <p><span style="font-weight: bold">Оформление заказа через интернет-магазин</span><br/>
                        Круглосуточно</p>
                </div>
            </div>
            <hr/>
                <address>
                <div class="row simple-text">
                    <div class="col-md-12 col-lg-12">
                        <p>
                            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                <span itemprop="postalCode">197082</span>,
                                <span itemprop="addressLocality">г. Санкт-Петербург</span>
                                <span itemprop="streetAddress">улица Туристская 23к2, оф. 20-Н</span><br/>
                                Тел.: <b><span itemprop="telephone"><?php echo Yii::app()->shop->phone ?></span></b>
                            </div>
                        </p>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <p>
                        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <span itemprop="postalCode">109387</span>,
                            <span itemprop="addressLocality">г. Москва</span>
                            <span itemprop="streetAddress">улица Люблинская 42, оф. 12</span><br/>
                            Тел.: <b><span itemprop="telephone">8 (499) 703-05-09</span></b>
                        </div>

                        </p>
                    </div>
                </div>

                <div class="row simple-text">
                    <div class="col-md-3 col-lg-3">ВКонтакте</div>
                    <div class="col-md-9 col-lg-9"><b><a href="https://vk.com/koptelovaea" target="_blank">vk.com/koptelovaea</a></b>
                    </div>
                </div>
                <div class="row simple-text">
                    <div class="col-md-3 col-lg-3">Почта</div>
                    <div class="col-md-9 col-lg-9"><b><a
                                href="mailto:<?php echo Yii::app()->shop->email ?>"><span itemprop="email"><?php echo Yii::app()->shop->email ?></span></a></b>
                    </div>
                </div>
                </address>
                <div class="row simple-text">
                    <div class="col-lg-12"><h4>Реквизиты</h4></div>
                </div>
                <div class="row simple-text">
                    <div class="col-lg-offset-3 col-md-9 col-lg-9"><span itemprop="name">ИП Коптелов Алексей Владленович</span></div>
                </div>
                <div class="row simple-text">
                    <div class="col-md-3 col-lg-3">ИНН</div>
                    <div class="col-md-9 col-lg-9">424623808213</div>
                </div>
                <div class="row simple-text">
                    <div class="col-md-3 col-lg-3">ОГРНИП</div>
                    <div class="col-md-9 col-lg-9">313424629000016</div>
                </div>
                <div class="row simple-text">
                    <div class="col-md-3 col-lg-3">Р/С</div>
                    <div class="col-md-9 col-lg-9">40802810902100009816<br/> в ОАО АКБ "Авангард"</div>
                </div>
                <div class="row simple-text">
                    <div class="col-md-3 col-lg-3">К/С</div>
                    <div class="col-md-9 col-lg-9">30101810000000000201</div>
                </div>
                <div class="row simple-text">
                    <div class="col-md-3 col-lg-3">БИК</div>
                    <div class="col-md-9 col-lg-9">044525201</div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row simple-text">
                <div class="col-lg-offset-3 col-md-9 col-lg-9"><h4>Форма обратной связи</h4></div>
            </div>
            <?php if (Yii::app()->user->hasFlash('contact')): ?>

                <div class="flash-success">
                    <?php echo Yii::app()->user->getFlash('contact'); ?>
                </div>

            <?php else: ?>

                <div class="form wide">

                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'contact-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                        'htmlOptions' => array(
                            "class" => "form-horizontal simple-text"
                        )
                    ));
                    ?>

                    <?php echo $form->errorSummary($model); ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-3 col-lg-3 control-label')); ?>
                        <div class="col-lg-5">
                            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
                            <?php echo $form->error($model, 'name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'email', array('class' => 'col-md-3 col-lg-3 control-label')); ?>
                        <div class="col-lg-5">
                            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 64)); ?>
                            <?php echo $form->error($model, 'email'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'subject', array('class' => 'col-md-3 col-lg-3 control-label')); ?>
                        <div class="col-lg-5">
                            <?php echo $form->textField($model, 'subject', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
                            <?php echo $form->error($model, 'subject'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'body', array('class' => 'col-md-3 col-lg-3 control-label')); ?>
                        <div class="col-lg-8">
                            <?php echo $form->textArea($model, 'body', array('class' => 'form-control', 'rows' => 5)); ?>
                            <?php echo $form->error($model, 'body'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-5">
                            <?php echo CHtml::submitButton('Отправить', array('class' => 'btn btn-danger btn-block')); ?>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>


<?php /*

        <div class="row">
            <div class="col-lg-12 text-center">
                <img style="display: inline-block !important;" src="/images/shema_prohoda.jpg" class="img-responsive" alt="Магазин детских игршек на Комендантском"/>
            </div>
        </div>
 */ ?>
    <div class="row">
        <div class="col-lg-12">
            <img src="/images/shop-web.jpg" class="img-responsive" alt="Магазин детских игршек на Комендантском"/>
        </div>
    </div>

</div>
</div>