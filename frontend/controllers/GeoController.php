<?php
class GeoController extends FrontEndController{

    public function actionAutoComplete(){
        $term = Yii::app()->getRequest()->getParam('term');

        if(Yii::app()->request->isAjaxRequest && $term) {
            $cities = Yii::app()->db->createCommand()
                ->select('id, name as value, full_name as label, postcode AS zip')
                ->from('geo')
                ->where('name LIKE "'.$term.'%" AND postcode != ""')
                ->queryAll();

            echo CJSON::encode($cities);
            Yii::app()->end();
        }
    }
} 