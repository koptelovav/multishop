<form id="filter">
    <div class="filter-block">
        <div class="filter-title">
            цена
        </div>

        <div class="filter-content">
            <div class="filter-price clearfix">
                <div class="filter-price-input">
                    <input type="text" id="filter-min-price" name="filter[min_price]" value="<?= isset($_GET['filter']['min_price']) ? $_GET['filter']['min_price'] : $filter['min_price'] ?>">
                </div>
                <div class="filter-price-input">
                    <input type="text" id="filter-max-price" name="filter[max_price]" value="<?= isset($_GET['filter']['max_price']) ? $_GET['filter']['max_price'] : $filter['max_price'] ?>">
                </div>
            </div>

            <div class="filter-price-slider clearfix">
                <input type="text" id="filter-price-slider"
                       data-slider-min="<?= $filter['min_price'] ?>"
                       data-slider-max="<?= $filter['max_price'] ?>"
                       data-slider-step="1"
                       data-slider-value="[<?= isset($_GET['filter']['min_price']) ? $_GET['filter']['min_price'] : $filter['min_price'] ?>,<?= isset($_GET['filter']['max_price']) ? $_GET['filter']['max_price'] : $filter['max_price'] ?>]"
                       data-slider-orientation="horizontal"
                       data-slider-selection="after"
                       data-slider-tooltip="hide" />
            </div>
        </div>
    </div>

    <?php if($filter['gender']): ?>
        <div class="filter-block">
            <div class="filter-title">
                пол
            </div>
            <div class="filter-content">
                <div class="filter-checkbox">
                    <?= CHtml::checkBoxList('filter[gender]',$_GET['filter']['gender'],CHtml::listData($filter['gender'],'id','value'));?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if($filter['age']): ?>
        <div class="filter-block">
            <div class="filter-title">
                возраст
            </div>
            <div class="filter-content">
                <div class="filter-checkbox">
                    <?= CHtml::checkBoxList('filter[age]',$_GET['filter']['age'],CHtml::listData($filter['age'],'id','value'));?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if($filter['brand']): ?>
        <div class="filter-block">
            <div class="filter-title">
                Бренд
            </div>
            <div class="filter-content">
                <div class="filter-checkbox">
                    <?= CHtml::checkBoxList('filter[brand]',$_GET['filter']['brand'],CHtml::listData($filter['brand'],'id','name'));?>
                </div>
            </div>
        </div>
    <?php endif ?>

</form>