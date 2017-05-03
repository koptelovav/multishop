<?php
$this->pageTitle = 'Контакты';
?>

<div class="static-page">
    <h1>Контакты</h1>
    <div class="static-page-content">
        <div class="row">
            <div class="col-lg-5">
                <div itemscope itemtype="http://schema.org/LocalBusiness">

                    <div class="col-lg-12">
                        <h3>График работы</h3>
                        <p><span style="font-weight: bold">Консультация по телефону: </span>
                            <time itemprop="openingHours" datetime="Mo-Fr 10:00−18:00">ПН-ПТ с 10:00 до 20:00 | CБ-ВС
                                выходной
                            </time>
                        </p>
                        <p><span style="font-weight: bold">Оналайн-консультант: </span>Ежедневно с 09:00 до 00:00<br/>
                        <p><span style="font-weight: bold">Оформление заказа в интернет-магазине: </span>Круглосуточно
                        </p>
                    </div>

                    <div class="col-lg-12">
                        <h3>Адрес и Контакты</h3>
                        <address>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <p>
                                    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                        <span itemprop="postalCode">197342</span>,
                                        <span itemprop="addressLocality">г. Санкт-Петербург</span>
                                        <span itemprop="streetAddress">улица Торжковская 5 лит А, пом. 9-Н</span><br/>
                                        Телефон: <b><span itemprop="telephone">8 (812) 309-68-83</span></b>
                                    </div>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-lg-3">ВКонтакте</div>
                                <div class="col-md-9 col-lg-9"><b><a href="https://vk.com/myhatchimals" target="_blank">vk.com/myhatchimals</a></b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-lg-3">Почта</div>
                                <div class="col-md-9 col-lg-9"><b><a
                                            href="mailto:info@myhatchimals.ru"><span itemprop="email">info@myhatchimals.ru</span></a></b>
                                </div>
                            </div>
                        </address>
                    </div>

                    <div class="row">
                        <div class="col-lg-12"><h3>Реквизиты</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-3 col-md-9 col-lg-9"><span itemprop="name">ООО "Квадратный метр" Игрушек"</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3">ИНН</div>
                        <div class="col-md-9 col-lg-9">7814665409</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3">ОГРН</div>
                        <div class="col-md-9 col-lg-9">1167847374221</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3">Р/С</div>
                        <div class="col-md-9 col-lg-9">40702810032280001803<br/> Филиал "Санкт-Петербургский" АО
                            "Альфа-Банк"
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3">К/С</div>
                        <div class="col-md-9 col-lg-9">30101810600000000786</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3">БИК</div>
                        <div class="col-md-9 col-lg-9">044030786</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
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
                                "class" => "form-horizontal"
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
    </div>
</div>