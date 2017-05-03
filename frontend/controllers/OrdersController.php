<?php

class OrdersController extends FrontEndController
{

    /**
     * View order web-mail
     * @param $id int Order ID
     * @throws CHttpException 404 if token is not compare
     */
    public function actionMail($id)
    {
        $this->layout = false;
        $order = Orders::model()->findByPk($id);
        $this->pageTitle = 'Заказ';
        $this->render('//mail/new-order2',array(
            'order' => $order
        ));
    }

    /**
     * Client order view
     */
    public function actionView()
    {
        $this->pageTitle = 'Просмотр заказа';
        $cartForm = new CartForm();
        $cartForm->attributes = Yii::app()->cart->getClientData();
        if($cartForm->order){
            $order = Orders::model()->findByPk($cartForm->order);
            $this->render('view', array(
                'order'=>$order
            ));
        }else{
            $this->redirect(Yii::app()->homeUrl);
        }

    }


    /**
     * Client order create
     * Requires $_POST['Orders'], $_POST['Customer'] and $_POST['CustomerAddress']
     */
    public function actionCreate()
	{
        $this->pageTitle = 'Оформление заказа';

        $cartForm = new CartForm();
        $cartForm->attributes = Yii::app()->cart->getClientData();

        if($cartForm->canOrder){
            //Создание моделей
            $order = new Orders;
            $customer = new Customers;
            $customerAddress = new CustomerAddress();

            //назначение обработчиков
            $smsNotifier = new SmsNotifier();
            $emailNotifier = new EmailNotifier();
            $tagManager = new TagManager();
            $order->onNewOrder = array($smsNotifier, 'order');
            $order->onNewOrder = array($emailNotifier, 'order');
            $order->onNewOrder = array($tagManager, 'newOrder');

            //Заполнение данными
            $customer->name = $cartForm->name;
            $customer->phone = $cartForm->phone;
            $customer->email = $cartForm->email;
            $customer->subscribe = $cartForm->subscribe;
            if($customer->save()){
                $customerAddress->id = $customer->id;
                $customerAddress->zip = $cartForm->zip;
                $customerAddress->city = $cartForm->city;
                $customerAddress->area = $cartForm->area;
                $customerAddress->street = $cartForm->street;
                $customerAddress->house = $cartForm->house;
                $customerAddress->apartment = $cartForm->apartment;
                $customerAddress->pvz = $cartForm->pvzList[$cartForm->pvz]['code'];
                $customerAddress->pvz_name = $cartForm->pvzList[$cartForm->pvz]['name'];
                $customerAddress->save();
            }else{
                var_export($customer->errors);die;
            }

            $order->send_no_call = $cartForm->send_no_call;

            if($order->send_no_call == CartForm::SEND_NO_CALL)
                $order->status = OrderStatus::ASSEMBLY;
            else
                $order->status = OrderStatus::defaultStatus();

            $order->payment_status = OrderPaymentStatus::defaultStatus();
            $order->shipping_price = $cartForm->getTotalShipping();
            $order->discount = $cartForm->discount;
            $order->total_price = $cartForm->getTotal();
            $order->shop_id = Yii::app()->shop->id;
            $order->shipping_id = $cartForm->shipping;
            $order->payment_id = $cartForm->payment;
            $order->comment = $cartForm->comment;
            $order->customer_id = $customer->id;
            $order->promo_code = $cartForm->promoCode;
            $order->save();

            foreach ($cartForm->products as $hash => $item) {
                $product = Products::model()->findByPk($item['id']);
                $orderProduct = new OrderProducts();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $product->id;
                $orderProduct->title = $product->title;
                $orderProduct->image = $product->image;
                $orderProduct->price = $item['price'];
                $orderProduct->count = $item['count'];
                $orderProduct->attributes_string = !empty($item['attributeString']) ? $item['attributeString'] : NULL;
                $orderProduct->save();
            }

            $event = new CModelEvent($order);
            $order->onNewOrder($event);

            $cartForm->setDefaultParams();
            $cartForm->order = $order->id;
            Yii::app()->cart->setClientData($cartForm->attributes);
            $this->redirect('view');
        }else{
            $this->redirect(Yii::app()->homeUrl);
        }
	}

    public function actionResult(){
        Yii::app()->robokassa->result();
    }

    public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
