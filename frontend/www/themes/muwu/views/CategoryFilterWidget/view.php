<form id="filter">
    <div class="filter-block">
        <div class="filter-title">
            цена
        </div>

        <div class="filter-content">
            <div class="filter-price clearfix">
                <div class="filter-price-input">
                    <input type="text" id="filter-min-price" name="filter[min_price]" value="<?= $this->filter['min_price'] ?>">
                </div>
                <div class="filter-price-input">
                    <input type="text" id="filter-max-price" name="filter[max_price]" value="<?= $this->filter['max_price'] ?>">
                </div>
            </div>

            <div class="filter-price-slider clearfix">
                <input type="text" id="filter-price-slider"
                       data-slider-min="<?= $this->filter['min_price'] ?>"
                       data-slider-max="<?= $this->filter['max_price'] ?>"
                       data-slider-step="1"
                       data-slider-value="[<?= $this->filter['min_price'] ?>,<?= $this->filter['max_price'] ?>]"
                       data-slider-orientation="horizontal"
                       data-slider-selection="after"
                       data-slider-tooltip="hide" />
            </div>
        </div>
    </div>

    <?php if($this->filter['gender']): ?>
        <div class="filter-block">
            <div class="filter-title">
                пол
            </div>
            <div class="filter-content">
                <div class="filter-checkbox">
                    <?= CHtml::checkBoxList('filter[gender]','',CHtml::listData($this->filter['gender'],'id','value'));?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if($this->filter['age']): ?>
        <div class="filter-block">
            <div class="filter-title">
                возраст
            </div>
            <div class="filter-content">
                <div class="filter-checkbox">
                    <?= CHtml::checkBoxList('filter[age]','',CHtml::listData($this->filter['age'],'id','value'));?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if($this->filter['brand']): ?>
        <div class="filter-block">
            <div class="filter-title">
                Бренд
            </div>
            <div class="filter-content">
                <div class="filter-checkbox">
                    <?= CHtml::checkBoxList('filter[brand]','',CHtml::listData($this->filter['brand'],'id','name'));?>
                </div>
            </div>
        </div>
    <?php endif ?>

</form>