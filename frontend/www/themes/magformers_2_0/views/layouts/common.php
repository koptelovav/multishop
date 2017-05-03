<?php $this->beginContent('//layouts/general'); ?>

<div id="page" class="fluid-container">
    <div class="row">
        <div class="col-sm-2 col-lg-2 sidebar-column">
            <?php if(isset($this->filter)): ?>
            <form id="filter">
                <div id="filter-message">
                    Найдено наборов: <span></span>
                </div>
                <div class="filter-block">
                    <div class="filter-title">
                        цена
                    </div>

                    <div class="filter-content">
                        <div class="filter-price clearfix">
                            <div class="filter-price-input">
                                <input type="text" id="filter-min-price" name="filter[min_price]" value="<?= isset($_GET['filter']['min_price']) ? $_GET['filter']['min_price'] : $this->filter['min_price'] ?>">
                            </div>
                            <div class="filter-price-input">
                                <input type="text" id="filter-max-price" name="filter[max_price]" value="<?= isset($_GET['filter']['max_price']) ? $_GET['filter']['max_price'] : $this->filter['max_price'] ?>">
                            </div>
                        </div>

                        <div class="filter-price-slider clearfix">
                        <input type="text" id="filter-price-slider"
                               data-slider-min="<?= $this->filter['min_price'] ?>"
                               data-slider-max="<?= $this->filter['max_price'] ?>"
                               data-slider-step="1"
                               data-slider-value="[<?= isset($_GET['filter']['min_price']) ? $_GET['filter']['min_price'] : $this->filter['min_price'] ?>,<?= isset($_GET['filter']['max_price']) ? $_GET['filter']['max_price'] : $this->filter['max_price'] ?>]"
                               data-slider-orientation="horizontal"
                               data-slider-selection="after"
                               data-slider-tooltip="hide" />
                        </div>
                    </div>
                </div>

                <?php if($this->filter['gender']): ?>
                    <div class="filter-block">
                        <div class="filter-title">
                            Пол
                        </div>
                        <div class="filter-content">
                            <div class="filter-checkbox">
                                <?= CHtml::checkBoxList('filter[gender]',$_GET['filter']['gender'],CHtml::listData($this->filter['gender'],'id','value'), array('data-name'=>'gender'));?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if($this->filter['size']): ?>
                    <div class="filter-block">
                        <div class="filter-title">
                            Размер
                        </div>
                        <div class="filter-content">
                            <div class="filter-checkbox">
                                <?= CHtml::checkBoxList('filter[size]',$_GET['filter']['size'],CHtml::listData($this->filter['size'],'id','value'), array('data-name'=>'size'));?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if($this->filter['level']): ?>
                    <div class="filter-block">
                        <div class="filter-title">
                            Уровень
                        </div>
                        <div class="filter-content">
                            <div class="filter-checkbox">
                                <?= CHtml::checkBoxList('filter[level]',$_GET['filter']['level'],CHtml::listData($this->filter['level'],'id','value'), array('data-name'=>'level'));?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if($this->filter['magformers_tags']): ?>
                    <div class="filter-block">
                        <div class="filter-title">
                            тэги
                        </div>
                        <div class="filter-content">
                            <div class="filter-checkbox">
                                <?= CHtml::checkBoxList('filter[magformers_tags]',$_GET['filter']['magformers_tags'],CHtml::listData($this->filter['magformers_tags'],'id','value'), array('data-name'=>'magformers_tags'));?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

          <?php /*      <a href="#" class="btn btn-primary btn-lg btn-block" onclick="return false;">Применить</a> */ ?>
            </form>
            <?php endif ?>

        </div>
        <a href="#" id="filter-button" class="visible-xs">Показать фильтр</a>
        <div class="col-sm-10 col-lg-10 main-column">
            <?php echo $content; ?>
        </div>
    </div>

</div>

<?php $this->endContent(); ?>
