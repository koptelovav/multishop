<?php
$sandBuild1 = Products::model()->findByPk(929);
$sandBuild2 = Products::model()->findByPk(930);
$sandBuild3 = Products::model()->findByPk(931);
$sandBuild4 = Products::model()->findByPk(932);
$sandBuild5 = Products::model()->findByPk(933);

$sandBox = Products::model()->findByPk(61);
$bigPlasticSandbox = Products::model()->findByPk(336);
$castleMolds = Products::model()->findByPk(120);
$plasticSandbox = Products::model()->findByPk(334);
$plasticEnglandSandbox = Products::model()->findByPk(386);

$spoonKnife = Products::model()->findByPk(301);
$moldsCastleNew = Products::model()->findByPk(371);
$zele  = Products::model()->findByPk(825);

$traktorNordik = Products::model()->findByPk(398);
$samosvalNordik = Products::model()->findByPk(387);
$nordik4 =Products::model()->findByPk(589);
$nordik3 =Products::model()->findByPk(633);
$nordikCrane =Products::model()->findByPk(658);
$nordikFireTruck =Products::model()->findByPk(659);
$nordikGorodskojTransport =Products::model()->findByPk(817);
$doroznieZnaki =Products::model()->findByPk(816);
$nordikGorodskojTransport =Products::model()->findByPk(817);
?>

<div class="section-title">Кинетический песок</div>
<div class="set-block">
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view',array('product'=>$sandBuild1, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$sandBuild2, 'col'=>3))?>
<!--            --><?php //$this->renderPartial('_view',array('product'=>$sandBuild3))?>
            <?php $this->renderPartial('_view',array('product'=>$sandBuild4, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$sandBuild5, 'col'=>3))?>
        </div>
    </div>
</div>

<hr>
<div class="section-title">Песочницы</div>
<div class="set-block">
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view',array('product'=>$plasticSandbox))?>
            <?php $this->renderPartial('_view',array('product'=>$bigPlasticSandbox))?>
            <?php $this->renderPartial('_view',array('product'=>$plasticEnglandSandbox))?>
        </div>
    </div>
</div>

<hr>
<div class="section-title">Аксессуары</div>
<div class="set-block">
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view',array('product'=>$spoonKnife, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$castleMolds, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$zele, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsCastleNew, 'col'=>3))?>
        </div>
    </div>
</div>

<hr>
<div class="section-title">Машинки для кинетического песка</div>
<div class="set-block">
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view',array('product'=>$traktorNordik, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$samosvalNordik, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$nordikCrane, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$nordikFireTruck, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$nordik3, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$nordik4, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$nordikGorodskojTransport, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$doroznieZnaki, 'col'=>3))?>
        </div>
    </div>
</div>

