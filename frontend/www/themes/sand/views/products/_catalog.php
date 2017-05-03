<?php
$sand1 = Products::model()->findByPk(28);
$sand5 = Products::model()->findByPk(37);
$sand25 = Products::model()->findByPk(331);

$sandColor1 = Products::model()->findByPk(855);
$sandColor2 = Products::model()->findByPk(856);
$sandColor3 = Products::model()->findByPk(857);
$sandColor4 = Products::model()->findByPk(858);
$sandColor5 = Products::model()->findByPk(859);
$sandColor6 = Products::model()->findByPk(860);
$sandColor7 = Products::model()->findByPk(861);
$sandColor8 = Products::model()->findByPk(862);
$sandColor9 = Products::model()->findByPk(863);

$sandBox = Products::model()->findByPk(61);
$bigPlasticSandbox = Products::model()->findByPk(336);
$castleMolds = Products::model()->findByPk(120);
$plasticSandbox = Products::model()->findByPk(334);
$plasticEnglandSandbox = Products::model()->findByPk(386);
$bigBoxOnWheel =Products::model()->findByPk(364);
$inflatableTray = Products::model()->findByPk(626);

$moldsAquarium = Products::model()->findByPk(369);
$moldsTransportation = Products::model()->findByPk(370);
$moldsCastleNew = Products::model()->findByPk(371);
$moldsFortress = Products::model()->findByPk(372);

$traktorNordik = Products::model()->findByPk(398);
$samosvalNordik = Products::model()->findByPk(387);
$seaMix = Products::model()->findByPk(445);
$zolushka = Products::model()->findByPk(396);
$bashni = Products::model()->findByPk(869);

$spoonKnife = Products::model()->findByPk(301);
//$setPail = Products::model()->findByPk(310);
//$moldsSummer = Products::model()->findByPk(297);
$moldsSea = Products::model()->findByPk(298);
//$moldsDino = Products::model()->findByPk(299);
$moldsCar = Products::model()->findByPk(300);
//$moldsTransport = Products::model()->findByPk(312);
//$moldsCakes = Products::model()->findByPk(313);
//$moldsAnimals = Products::model()->findByPk(322);
$moldsFruits = Products::model()->findByPk(397);
$moldsAfrika = Products::model()->findByPk(835);

$nordik4 =Products::model()->findByPk(589);
$nordik3 =Products::model()->findByPk(633);
$nordikCrane =Products::model()->findByPk(658);
$nordikFireTruck =Products::model()->findByPk(659);
$nordikGorodskojTransport =Products::model()->findByPk(817);
$doroznieZnaki =Products::model()->findByPk(816);
//$skoda =Products::model()->findByPk(593);

$nordikGorodskojTransport =Products::model()->findByPk(817);

//$setOptima1 = Products::model()->findByPk(634);
$setOptima2 = Products::model()->findByPk(638);
//$setOptima12 = Products::model()->findByPk(864);
$setOptima4 = Products::model()->findByPk(646);
$setOptima5 = Products::model()->findByPk(650);
$setOptima6 = Products::model()->findByPk(654);
$setOptima7 = Products::model()->findByPk(831);
$setOptima8 = Products::model()->findByPk(838);
$setOptima9 = Products::model()->findByPk(843);
$setOptima10 = Products::model()->findByPk(847);
$setOptima11 = Products::model()->findByPk(851);
$setOptima14 = Products::model()->findByPk(873);
$setOptima15 = Products::model()->findByPk(895);

$setPremium1 = Products::model()->findByPk(899);
$setPremium2 = Products::model()->findByPk(903);
$setPremium3 = Products::model()->findByPk(907);

$miniSetMalysh = Products::model()->findByPk(892);
$miniSetKrepysh = Products::model()->findByPk(893);
$miniSetSea = Products::model()->findByPk(894);

$cinderellaSet = Products::model()->findByPk(539);
$boysSet = Products::model()->findByPk(540);
$girlsSet = Products::model()->findByPk(541);
$builderSet = Products::model()->findByPk(544);
$seaSet = Products::model()->findByPk(547);
$megaSet = Products::model()->findByPk(545);
$pddSet = Products::model()->findByPk(820);
$kuhnyaSet = Products::model()->findByPk(823);

$zele  = Products::model()->findByPk(825);
$spokiNoki  = Products::model()->findByPk(826);
$kotenokMedved  = Products::model()->findByPk(827);
$lednikiviJPeriod  = Products::model()->findByPk(828);
$desert  = Products::model()->findByPk(829);
$frukty = Products::model()->findByPk(830);
$morskieZiteli = Products::model()->findByPk(833);

$originalSet1 = Products::model()->findByPk(920);
$originalSet2 = Products::model()->findByPk(921);
$originalSet3 = Products::model()->findByPk(922);
$originalSet4 = Products::model()->findByPk(923);
$originalSet5 = Products::model()->findByPk(919);

$dragSand1 = Products::model()->findByPk(924);
$dragSand2 = Products::model()->findByPk(925);
$dragSand3 = Products::model()->findByPk(926);
$dragSand4 = Products::model()->findByPk(927);
$dragSand5 = Products::model()->findByPk(928);
$dragSand6 = Products::model()->findByPk(956);
$dragSand7 = Products::model()->findByPk(957);

$color1 = Products::model()->findByPk(934);
$color2 = Products::model()->findByPk(935);
$color3 = Products::model()->findByPk(936);
$color4 = Products::model()->findByPk(937);
?>

<div class="set-block green">
    <div class="set-header">Кинетический песок</div>
    <div class="set-description">
        Главный товар нашего магазина! Мы представляем Вам «умный» кинетический песок различного объема и цветной песок. Здесь Вы сможете выбрать самый подходящий вариант по удобной для Вас цене, и при этом получите подарок! Познакомьте малыша с новым интересным материалом или дополните его песочницу большим объемом кинетического песка. Разнообразьте игру ребенка красным, синим, зеленым песком или приобретите набор цветного песка и получите свой подарок!
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view',array('product'=>$sand1))?>
            <?php $this->renderPartial('_view',array('product'=>$sand5))?>
            <?php $this->renderPartial('_view',array('product'=>$sand25))?>
            <?php $this->renderPartial('_view',array('product'=>$color1))?>
            <?php $this->renderPartial('_view',array('product'=>$color2))?>
            <?php $this->renderPartial('_view',array('product'=>$color3))?>
            <?php $this->renderPartial('_view',array('product'=>$color4))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor1))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor2))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor3))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor4))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor5))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor6))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor7))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor8))?>
            <?php $this->renderPartial('_view',array('product'=>$sandColor9))?>
        </div>
    </div>
</div>

<div class="set-block blue">
    <div class="set-header">Оригинальные наборы Kinetic Sand&trade;</div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $originalSet1)) ?>
            <?php $this->renderPartial('_view', array('product' => $originalSet2)) ?>
            <?php $this->renderPartial('_view', array('product' => $originalSet3)) ?>
            <?php $this->renderPartial('_view', array('product' => $originalSet4)) ?>
            <?php $this->renderPartial('_view', array('product' => $originalSet5)) ?>
        </div>
    </div>
</div>

<div class="set-block purple">
    <div class="set-header">"Драгоценные" цвета Kinetic Sand&trade;</div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $dragSand1)) ?>
            <?php $this->renderPartial('_view', array('product' => $dragSand2)) ?>
            <?php $this->renderPartial('_view', array('product' => $dragSand3)) ?>
            <?php $this->renderPartial('_view', array('product' => $dragSand4)) ?>
            <?php $this->renderPartial('_view', array('product' => $dragSand5)) ?>
            <?php $this->renderPartial('_view', array('product' => $dragSand6)) ?>
            <?php $this->renderPartial('_view', array('product' => $dragSand7)) ?>
        </div>
    </div>
</div>

<div class="set-block red">
    <div class="set-header">premium</div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $setPremium1)) ?>
            <?php $this->renderPartial('_view', array('product' => $setPremium2)) ?>
            <?php $this->renderPartial('_view', array('product' => $setPremium3)) ?>
        </div>
    </div>
</div>

<div class="set-block blue">
    <div class="set-header">optima</div>
    <div class="set-description">
        Серия наборов «Оптима» - это не только полезное приобретение для Вашего малыша, но и весьма выгодное для Вас. Вы можете подобрать для ребенка интересные ему тематические формочки одного из трех наборов, необходимый объем песка или цветной песок. Приобретение данного набора – это «оптимальная» покупка. Выгодные цены, свободный выбор и бесценная польза для развития Вашего малыша.<br /><br />
        При покупке любого набора "Оптима" на <?= CHtml::link('контейнер-песочницу', array('products/view', 'id'=>$bigPlasticSandbox->id)) ?> (с крышкой) скидка 50%!
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $setOptima2, 'gift' => true)) ?>
            <?php $this->renderPartial('_view', array('product' => $setOptima15, 'gift' => true)) ?>
            <?php $this->renderPartial('_view', array('product' => $setOptima8, 'gift' => true)) ?>
            <?php $this->renderPartial('_view', array('product' => $setOptima14, 'gift' => true)) ?>
            <?php $this->renderPartial('_view', array('product' => $setOptima9, 'gift' => true)) ?>
            <?php $this->renderPartial('_view', array('product' => $setOptima7, 'gift' => true)) ?>
            <?php $this->renderPartial('_view', array('product' => $setOptima11, 'gift' => true)) ?>
            <?php $this->renderPartial('_view', array('product' => $setOptima10, 'gift' => true)) ?>
        </div>
    </div>
</div>


<div class="set-block purple">
    <div class="set-header">classic</div>
    <div class="set-description">
        Классические наборы! Мы представляем Вам ряд классических наборов различной комплектации. Здесь Вы можете выбрать самое различное сочетание тематических формочек, контейнеров и объемов кинетического песка. Это выгодное и очень удобное предложение. Выбирая набор, обратите внимание на предпочтения Вашего малыша и предоставьте ему возможность проводить время в интересной и очень полезной игре. И мальчики и девочки будут рады такому подарку. А Вы всегда сможете дополнить классический набор любыми товарами из нашего каталога.
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $builderSet)) ?>
            <?php $this->renderPartial('_view', array('product' => $megaSet)) ?>
        </div>
    </div>
</div>

<div class="set-block green">
    <div class="set-header">mini</div>
    <div class="set-description">
        Наборы для самых маленьких! Данные мини-наборы предназначены для самых юных пользователей. С их помощью малыш сможет познакомиться с удивительными свойствами нового материала, освоить базовые знания лепки и сюжетные игры. Небольшой объем кинетического песка, удобные для маленьких ручек формочки разной тематики и практичный контейнер-песочница, в котором можно не только играть, но и хранить песок. Вы всегда сможете дополнить свой мини-набор новыми формочками и количеством песка.<br /><br />
        При покупке любого "мини-сета" <?= CHtml::link('ложка-нож', array('products/view', 'id'=>301)) ?> идет в подарок!
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $miniSetMalysh, 'gift'=>true)) ?>
            <?php $this->renderPartial('_view', array('product' => $miniSetKrepysh, 'gift'=>true)) ?>
            <?php $this->renderPartial('_view', array('product' => $miniSetSea, 'gift'=>true)) ?>
        </div>
    </div>
</div>

<div class="set-block blue">
    <div class="set-header">boys</div>
    <div class="set-description">
        Лучшие наборы для мальчиков! Сделайте подарок маленькому мужчине, выбрав один из наборов, в который входят тематические формочки машинок, транспорта и пр. Малыш будет увлечен полезной игрой, познакомиться со свойствами кинетического песка и новыми интересными формами. Вы можете выбрать понравившийся Вам набор и объем песка к нему. Получите большой и удобный контейнер для хранения песка, а с одним из наборов еще и скидку на его доставку.
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $pddSet)) ?>
            <?php $this->renderPartial('_view', array('product' => $boysSet)) ?>
        </div>
    </div>
</div>

<div class="set-block pink">
    <div class="set-header">girls</div>
    <div class="set-description">
        Лучшие наборы для девочек! Ваша малышка будет рада такому подарку. Тематические формочки выполнены в розовых тонах, что порадует Вашу принцессу, к сожалению, данные формочки доступны покупателю только в составе данного набора. Помимо формочек в набор входит практичный контейнер для хранения песка. Вы можете выбрать необходимый объем песка, а с одним из наборов Вы получите скидку на доставку. Для более удобной и интересной игры, обратите внимание на песочницы и аксессуары в нашем каталоге.
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view', array('product' => $kuhnyaSet)) ?>
            <?php $this->renderPartial('_view', array('product' => $cinderellaSet)) ?>
            <?php $this->renderPartial('_view', array('product' => $girlsSet)) ?>
        </div>
    </div>
</div>

<div class="set-block green">
    <div class="set-header">Песочницы</div>
    <div class="set-description">
        Очень полезное дополнение! Где малышу играть с песком как не в песочнице. Мы предоставляем Вам полноценный выбор песочниц для кинетического песка по доступным ценам. В них можно играть как дома, так и на улице, а также хранить песок. Каждый товар обладает своими преимуществами и предназначен для разных объемов песка. Ребенку будет удобно играть в них, и он научится порядку и такому понятию как: «каждой вещи – свое место». Познакомьтесь с данными товарами и сделайте свой выбор.
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view',array('product'=>$plasticSandbox))?>
            <?php $this->renderPartial('_view',array('product'=>$bigPlasticSandbox))?>
            <?php $this->renderPartial('_view',array('product'=>$plasticEnglandSandbox))?>
            <?php $this->renderPartial('_view',array('product'=>$inflatableTray))?>
            <?php $this->renderPartial('_view',array('product'=>$bigBoxOnWheel))?>
        </div>
    </div>
</div>

<div class="set-block blue">
    <div class="set-header">Аксессуары</div>
    <div class="set-description">
        Лучший способ разнообразить игру! Аксессуары являются идеальным дополнением и способны не только разнообразить игровой процесс, но и создать новые миры в воображении Вашего малыша. Разные тематические формочки, с помощью которых можно воссоздать морской мир, летнее настроение, животный и доисторический мир, построить замок и башенки, машинки и прочую технику. Ведерце, грабельки, лопатка, трактор и самосвал – сделают игру увлекательной и динамичной. Вы найдете здесь все, что сможет понравиться Вашему малышу.
    </div>
    <div class="set-content">
        <div class="row">
            <?php $this->renderPartial('_view',array('product'=>$spoonKnife, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$castleMolds, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsSea, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsCar, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$bashni, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$zele, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$morskieZiteli, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsAquarium, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsAfrika, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$desert, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$frukty, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$lednikiviJPeriod, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsCastleNew, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsTransportation, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$zolushka, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$spokiNoki, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$kotenokMedved, 'col'=>3))?>
            <?php $this->renderPartial('_view',array('product'=>$moldsFortress, 'col'=>3))?>
        </div>
    </div>
</div>

<div class="set-block red">
    <div class="set-header">Машинки для кинетического песка </div>
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
