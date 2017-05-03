<?php

/**
 * Base billing controller
 * Class BillingController
 */
class BillingController extends FrontEndController{
    const PAYMENT_ROBOKASSA = 'paymentRobokassa';
    const PAYMENT_YANDEXKASSA = 'paymentYandexKassa';
    const PAYMENT_AVANGARD = 'paymentAvangard';
    const PAYMENT_INVOICE = 'paymentInvoice';

    public function filters(){
        return array(
            'rights'
        );
    }

    /**
     * Order payment
     * @throws CHttpException 404
     */
    public function actionPayment(){
        $id = isset($_GET['id']) ? $_GET['id'] : (isset(Yii::app()->session['order_id']) ? Yii::app()->session['order_id'] : false);
        if($id){
            $order = Orders::model()->findByPk($id);

            $orderPayment = $order->payment;
            if($paymentMethod = $orderPayment->redirect)
                $method = $paymentMethod;
            else
                $method = self::PAYMENT_AVANGARD;
            Yii::app()->$method->pay($order->total, $order->id, 'Оплата заказа №'.$id.' в магазине '.Yii::app()->shop->title, $order->customer->email, $orderPayment->params);
        }else{
            throw new CHttpException(400, 'Bad request');
        }
    }

    /**
     * View successful payment page
     */
    public function actionSuccess(){
        $this->render('//billing/success');
    }

    /**
     * View fail payment page
     */
    public function actionFail(){
        $this->render('//billing/fail');
    }

    /**
     * Success payment event handler
     * @param $event CEvent
     */
    protected function paymentSuccess($event){
        /* @var $order Orders */

        $order = $event->sender->params['order'];
        if($order->payment_status != OrderPaymentStatus::PAID){
            $order->payment_status = OrderPaymentStatus::PAID;
            $order->status = OrderStatus::SHIPMENT;
            $order->update_payment_status = new CDbExpression('NOW()');
            $order->save();

            Yii::app()->sms->send($order->customer->phone, 'Заказ No.'.$order->id.' успешно оплачен и передан на сборку.', 'MuWu.ru');

            switch($order->shipping_id) {
                case Shipping::MSC_STORE_SHIPPING:
                case Shipping::CDEK_STORE_SHIPPING:
                case Shipping::CDEK_SPB:
                    $order->cdekRegister();
                    break;
            }
            unset(Yii::app()->session['order_id']);
        }
    }

    /**
     * Fail payment event handler
     * @param $event CEvent
     */
    protected function paymentFail($event){
        /* @var $order Orders */

        if(isset(Yii::app()->session['order_id'])){
            $order = Orders::model()->findByPk(Yii::app()->session['order_id']);
            $order->payment_status = OrderPaymentStatus::FAIL;
            $order->update_payment_status = new CDbExpression('NOW()');
            $order->log = $this->getLastPaymentLog($event);
            $order->save();

            unset(Yii::app()->session['order_id']);
        }
    }

    /*TODO Удалить этот метод*/
    protected function getLastPaymentLog($event){
        $log = '';

        foreach(($_GET + $_POST) as $key=>$value)
            $log .= $key.': '.$value."\n";

        if(isset($event->sender->params['reason']))
            $log .= 'reason: '.$event->sender->params['reason'];

        return $log;
    }

    /* Действие для оплаты по счету */

    public function actionInvoice(){
        if(Yii::app()->request->getParam('id',false)){
            $order = Orders::model()->findByPk(Yii::app()->request->getParam('id'));

            if(Yii::app()->request->getParam('download',false)){
                $mPDF1 = Yii::app()->ePdf->mpdf();
                # Load a stylesheet
                $stylesheet = file_get_contents(Yii::getPathOfAlias('frontend.www.css') . '/invoice.css');
                $mPDF1->WriteHTML($stylesheet, 1);

                # renderPartial (only 'view' of current controller)
                $mPDF1->WriteHTML($this->renderPartial('/orders/invoice/_view', array(
                    'order' => $order
                ), true));

                # Outputs ready PDF
                $mPDF1->Output('Счет_на_оплату_заказа_'.$order->id.'.pdf', 'D');
            }

            $this->renderPartial('/orders/invoice/view', array(
                'order' => $order
            ));
        }else{
            throw new CHttpException(404);
        }
    }
}

