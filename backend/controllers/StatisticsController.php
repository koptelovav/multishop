<?php
class StatisticsController extends BackEndController{

    public function actionDynamicsOrders(){
        $this->pageTitle = 'Динамика заказов';

        $command = Yii::app()->db->createCommand();

        $startDate = $command
            ->select('DATE_FORMAT(date, "%Y-%m-%d")')
            ->from('orders')
            ->order('date ASC')
            ->limit(1)
            ->queryScalar();

        $startDate = date('U',strtotime($startDate))*1000;
        $command->reset();  // очищаем предыдущий запрос

        $ordersCount = $command
            ->select('DATE_FORMAT(`date`, "%x-%v") weeks, COUNT(*) as count')
            ->from('orders')
            ->group('weeks')
            ->queryAll();

        $data = array();
        $dataSum = array();
        foreach($ordersCount as $count){
            $data[] = (int)$count['count'];

            $command->reset();  // очищаем предыдущий запрос

            $summ = $command
                ->select('SUM(total_price)')
                ->from('orders')
                ->where('DATE_FORMAT(`date`, "%x-%v") = "'.$count['weeks'].'" AND (payment_status = 2 OR shipping_id = 4 OR shipping_id = 6)')
                ->queryColumn();

            $dataSum[] = (int)$summ[0];
        }


        $dataSum = CJSON::encode($dataSum);
        $data = CJSON::encode($data);
        $this->render('dynamicsOrders',array(
            'data'=>$data,
            'dataSum'=>$dataSum,
            'startDate'=>$startDate
        ));
    }

    public function actionOrdersStatus(){
        $command = Yii::app()->db->createCommand();

        $orders = $command
            ->select('COUNT(*) as count, status')
            ->from('orders')
            ->group('status')
            ->queryAll();



        $statuses = CHtml::listData(OrderStatus::model()->findAll(),'id','name');
        $data = array();
        foreach($orders as $row){
            $data[] = array($statuses[$row['status']],(int)$row['count']);
        }

        $data = CJSON::encode($data);
        $this->render('ordersStatus',array(
            'data'=>$data,
        ));
    }
}