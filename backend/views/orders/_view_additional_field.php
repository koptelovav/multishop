<?php if($field = $model->getAdditionalFieldByName($fieldName)): ?>
    <dt><?php echo $field->params->title; ?></dt>
    <dd>
        <?php
        $params = array(
            'type' => $field->params->type,
            'pk' => $fieldName,
//            'model' => $field,
            'name' => 'value',
            'text' => $field->value,
            'url' => $this->createUrl('orders/orderAdditionalFieldUpdate', array('order_id'=>$model->id)),
            'placement' => 'right',
//            'liveTarget' => 'main',
            'onSave' => 'js: function(e, params) {
//                              $.ajax({
//                                type: "POST",
//                                url: window.location.href,
//                                success: function(data){
//                                    $("#main").html($(data).find("#main"));
//                                    $("#main").trigger("ajaxUpdate.editable");
//                                }
//                           })
                        }'
        );

        switch($field->params->type){
            case 'select':
                $params['source'] = Editable::source($field->params->values, 'id', 'value');
                break;
            case 'date':
                $params['format'] = 'dd.mm.yyyy';
                $params['viewformat'] = 'dd.mm.yyyy';
                break;
        }

        $this->widget('editable.Editable', $params);
        ?>
    </dd>
<?php endif; ?>