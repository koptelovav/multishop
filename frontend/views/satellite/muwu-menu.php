<nav id="muwu-menu" class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand visible-xs">Все магазины</span>
        </div>

        <div class="collapse navbar-collapse navbar-ex2-collapse">
            <?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                    array('label' => 'Му-Ву!', 'url' =>  SHtml::crossDomainLink('http://muwu.ru')),
                    array('label' => 'Kinetic Sand', 'url' => SHtml::crossDomainLink('http://kineticsand.ru')),
                    array('label' => 'Bloco<sup style="color: #ff6864">NEW</sup>', 'url' => SHtml::crossDomainLink('http://blocotoy.ru')),
                    array('label' => 'SuperStructs', 'url' =>  SHtml::crossDomainLink('http://superstructs.ru')),
                    array('label' => 'Magformers', 'url' =>  SHtml::crossDomainLink('http://mymagformers.ru'))
                ),
                'encodeLabel' => false,
                'htmlOptions' => array(
                    'class' => 'nav navbar-nav navbar-right'
                )
            )); ?>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>