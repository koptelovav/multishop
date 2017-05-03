<?php $this->beginContent(Rights::module()->appLayout); ?>

<div id="rights" class="container">

	<div id="content">

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <?= $this->pageTitle ?>
            <div class="control pull-right">
                <?php $this->renderPartial('/_menu'); ?>
            </div>
        </div>
        <div class="panel-body">
            <?php $this->renderPartial('/_flash'); ?>
            <?php echo $content; ?>

	</div><!-- content -->

</div>

<?php $this->endContent(); ?>