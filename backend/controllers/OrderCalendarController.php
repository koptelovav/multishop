<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey.koptelov
 * Date: 18.01.14
 * Time: 18:30
 * To change this template use File | Settings | File Templates.
 */

class OrderCalendarController extends BackEndController {
    public $pageTitle = 'Календарь заказов';

    public function actionIndex(){

        $days = array();
        $month= isset($_GET['m']) ? $_GET['m'] : date('m');
        $year = date('Y');
        $maxDay = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));

        for($i = 1;$i<=$maxDay;$i++){
            $date = $year.'-'.$month.'-'.$i;
            $days[$i] = Orders::model()->findAllByAttributes(array('delivery_date'=>$date));
        }
        $this->render('index', array(
            'month' => SHtml::monthToString($month),
            'days' => $days
        ));
    }
}