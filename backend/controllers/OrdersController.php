<?php

class OrdersController extends BackEndController
{
    public $pageTitle = 'Заказы';
    public $controllerModelName = 'Orders';

    public function actionSale($id){
        Orders::model()->findByPk($id)->sale();
    }


    public function actionPicker(){
        $model = new Orders;
        $criteria = new CDbCriteria;

        $criteria->compare('status',10);
        $criteria->compare('status',12, false, 'OR');
        $criteria->compare('status',13, false, 'OR');
        $criteria->order = 'priority DESC, update_payment_status ASC';

        $dataProvider = new CActiveDataProvider('Orders', array(
            'criteria' => $criteria,
            'pagination'=>array('pageSize'=>20)
        ));

        $this->render('picker',array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

	public function actionView($id)
	{
        $this->buttonCurrentTemplate = '{return} {delete}';
        $model = $this->loadModel($id);
        $customer = $model->customer;
        $customerAddress = $customer->address;
        $customerEntityInfo = $customer->entityInfo;
     //   $view = $model->issetTag(OrderTag::RESERV) && !Yii::app()->user->checkAccess('admin') ? 'view_reserved' : 'view';

		$this->render('view',array(
			'model'=> $model,
            'customer' => $customer,
            'customerAddress' => $customerAddress,
            'customerEntityInfo' => $customerEntityInfo,
		));
	}

    public function actionPrint($id, $type){
        $model = $this->loadModel($id);
        $customer = $model->customer;
        $customerAddress = $customer->address;

        $this->renderPartial('print/'.$type,array(
            'model'=> $model,
            'customer' => $customer,
            'customerAddress' => $customerAddress,
        ));
    }

	public function actionCreate()
	{
        $this->buttonCurrentTemplate = $this->buttonEditTemplate;

		$order = new Orders;
        $order->setScenario('admin');
        $order->status = OrderStatus::defaultStatus();
        $order->payment_status = OrderPaymentStatus::defaultStatus();

        $customer = new Customers;
        $customer->setScenario('admin');
        $customer->name = 'Administrator';
        if($customer->save()){
            $order->customer_id = $customer->id;
            if($order->save())
                $this->redirect(array('view','id'=>$order->id));
        }
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
			$model->save();
		}
	}

    public function actionCopy($id)
    {
        $model=$this->loadModel($id);
        $newOrder = new Orders();
        $newOrder->attributes = $model->attributes;
        $newOrder->track = null;
        $newOrder->shipping_price = null;

        $newCustomer = new Customers();
        $newCustomer->attributes = $model->customer->attributes;
        if($newCustomer->save()){
            if($model->customer->address){
                $newCustomerAddress = new CustomerAddress();
                $newCustomerAddress->attributes = $model->customer->address->attributes;
                $newCustomerAddress->id = $newCustomer->id;
                $newCustomerAddress->save();
            }
            if($model->customer->entityInfo){
                $newCustomerEntityInfo = new CustomerEntityInfo();
                $newCustomerEntityInfo->attributes = $model->customer->entityInfo;
                $newCustomerEntityInfo->id = $newCustomer->id;
                $newCustomerEntityInfo->save();
            }

            $newOrder->customer_id = $newCustomer->id;
            $newOrder->save();
            $this->redirect(array('view', 'id'=>$newOrder->id));
        }
    }


    public function actionOrderEditableServerUpdate($model)
    {
        $orderLog = new OrderLog();
        $es = new EditableSaver($model);
        $es->onAfterUpdate = array($orderLog, 'writeFromEditableServer');
        $es->update();
    }

    public function actionOrderAdditionalFieldUpdate($order_id)
    {
        $order = Orders::model()->findByPk($order_id);
        $orderAdditionalField = $order->getAdditionalFieldByName($_POST['pk']);
        $orderAdditionalField->value = $_POST['value'];
        $orderAdditionalField->save();
        var_export($orderAdditionalField->errors);
    }

	public function actionDelete($id)
	{
        $order = $this->loadModel($id);
        if($order->customer){
            if($order->customer->address)
                $order->customer->address->delete();
            $order->customer->delete();
        }

        $order->delete();

        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

    public function actionSummary(){
        $sql = 'select id, title, sum(count)  as count from (

    SELECT
                  DISTINCT op.`product_id` AS ID,
                  p.title as title,
                  SUM(op.`count`) as count
                FROM `order_products` op
                LEFT JOIN `orders` o ON op.order_id = o.id
                LEFT JOIN `products` p ON op.product_id = p.id
                LEFT JOIN `product_include` pi ON p.id= pi.product_id
                WHERE o.status = 10 AND pi.include_id is NULL
                GROUP BY op.`product_id`
   union all
    SELECT
                  DISTINCT pi.`include_id` AS ID,
                  p.title as title,
                SUM(pi.`count` * op.count) as count
                FROM `order_products` op
                LEFT JOIN `orders` o ON op.order_id = o.id
                LEFT JOIN `product_include` pi ON pi.product_id= op.product_id
                LEFT JOIN `products` p ON  pi.`include_id`  = p.id
                WHERE o.status = 10 AND pi.include_id IS NOT NULL
                GROUP BY pi.`include_id`
    union all
    SELECT
                DISTINCT og.`gift_id` AS ID,
                  p.title as title,
                SUM(og.count) as count
                FROM `order_gift` og
                LEFT JOIN `orders` o ON og.order_id = o.id
                LEFT JOIN `products` p ON og.gift_id = p.id
                WHERE o.status = 10
                GROUP BY og.`gift_id`
) x group by id';

        $dataProvider=new CSqlDataProvider($sql, array(
            'pagination'=>array(
                'pageSize'=>100,
            ),
        ));

        $this->render('summary', array('dataProvider'=>$dataProvider));
    }

    public function actionIndexII()
    {
        $this->buttonCurrentTemplate = '{add}';

        $model=new Orders('search');
        $model->customerData = new Customers();
        $model->customerAddressData = new CustomerAddress();

        $model->unsetAttributes();  // clear any default values
        $model->customerData->unsetAttributes();

        if(isset($_GET['Orders']))
            $model->attributes=$_GET['Orders'];
        if(isset($_GET['Customers']))
            $model->customerData->attributes = $_GET['Customers'];
        if(isset($_GET['CustomerAddress']))
            $model->customerAddressData->attributes = $_GET['CustomerAddress'];

        $sort = new CSort;

        $sort->defaultOrder = array(
            'date'=>CSort::SORT_DESC,
        );

        $dataProvider = new CActiveDataProvider('Orders', array(
            'sort' => $sort,
            'pagination'=>array('pageSize'=>20)
        ));

        $this->render('index',array(
            'dataProvider' => $dataProvider,
            'model' => $model,
            'sort' => $sort
        ));
    }

	public function actionIndex()
	{
        $this->buttonCurrentTemplate = '{add}';

        $model=new Orders('search');
        $model->customerData = new Customers();
        $model->customerAddressData = new CustomerAddress();

        $model->unsetAttributes();  // clear any default values
        $model->customerData->unsetAttributes();

        if(isset($_GET['Orders']))
            $model->attributes=$_GET['Orders'];
        if(isset($_GET['Customers']))
            $model->customerData->attributes = $_GET['Customers'];
        if(isset($_GET['CustomerAddress']))
            $model->customerAddressData->attributes = $_GET['CustomerAddress'];

        $sort = new CSort;
        $sort->multiSort = true;
        $sort->attributes = array(
            'date'=>array(
                'asc'=>'date',
                'desc'=>'date DESC',
                'label'=>'дате создания',
            ),
            'update_payment_status'=>array(
                'asc'=>'update_payment_status',
                'desc'=>'update_payment_status DESC',
                'label'=>'дате оплаты',
            )
        );
        $sort->defaultOrder = array(
            'date'=>CSort::SORT_DESC,
        );

        $dataProvider = new CActiveDataProvider('Orders', array(
            'criteria' => SHtml::getAllOrdersCriteria(),
            'sort' => $sort,
            'pagination'=>array('pageSize'=>20)
        ));

		$this->render('index',array(
            'dataProvider' => $dataProvider,
			'model' => $model,
            'sort' => $sort
		));
	}

    public function actionAddCustomerAddress($id){
        $order = $this->loadModel($id);
        $customerAddress = new CustomerAddress;
        $customerAddress->id = $order->customer_id;

        $sql="INSERT INTO customer_address (id) VALUES(:id)";
        $command=Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $order->customer_id,PDO::PARAM_STR);
        if($command->execute()){
            $this->redirect(array('view','id'=>$order->id));
        }
    }

    public function actionAddCustomerEntityInfo($id){
        $order = $this->loadModel($id);
        $customerEntityInfo = new CustomerEntityInfo();
        $customerEntityInfo->id = $order->customer_id;

        $sql="INSERT INTO customer_entity_info (id) VALUES(:id)";
        $command=Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $order->customer_id,PDO::PARAM_STR);
        if($command->execute()){
            $this->redirect(array('view','id'=>$order->id));
        }
    }

    public function actionAddProduct(){

        $product = Products::model()->findByPk(Yii::app()->request->getParam('product_id'));
        $count = Yii::app()->request->getParam('count');
        $price = Yii::app()->request->getParam('product_price');
        $orderId = Yii::app()->request->getParam('order_id');
        $attributes = Yii::app()->request->getParam('attributes', array());
        $attributeString = '';
        foreach ($attributes as $item){
            $attributeValue = AttributeValue::model()->findByPk($item);
            $attributeString .= $attributeValue->attribute->title.': '.$attributeValue->value.'; ';
        }

        $orderProducts = OrderProducts::model()->findByAttributes(array(
            'order_id' => $orderId,
            'product_id' => $product->id,
            'price' => $price,
            'attributes_string' => $attributeString
        ));

        if($orderProducts){
            $orderProducts->count = $orderProducts->count + $count;
        }else{
            $orderProducts = new OrderProducts;
            $orderProducts->order_id = $orderId;
            $orderProducts->product_id = $product->id;
            $orderProducts->title = $product->title;
            $orderProducts->price = $price;
            $orderProducts->count = $count;
            $orderProducts->attributes_string = $attributeString;
        }
        $orderProducts->save();
    }

    public function actionChangeProduct(){
        $productId = Yii::app()->request->getParam('product_id');
        $count = Yii::app()->request->getParam('count');

        $orderProducts = OrderProducts::model()->findByPk($productId);
        $orderProducts->count = $count;
        $orderProducts->save();
    }

    public function actionSendTrack(){
        if(Yii::app()->request->isPostRequest){
            $order = Orders::model()->findByPk($_POST['id']);

            if($order){
                $smsNotifier = new SmsNotifier();
                $emailNotifier = new EmailNotifier();

                if($order->customer->phone)
                    $order->onSendTrack = array($smsNotifier, 'sendOrderTrack');
                if($order->customer->email)
                    $order->onSendTrack = array($emailNotifier, 'sendOrderTrack');

                $event = new CModelEvent($order);
                $order->onSendTrack($event);
            }
        }
    }

    public function actionSendStatus(){
        if(Yii::app()->request->isPostRequest){
            $order = Orders::model()->findByPk($_POST['id']);

            if($order){
                $smsNotifier = new SmsNotifier();
//                $emailNotifier = new EmailNotifier();

                if($order->customer->phone)
                    $order->onSendTrack = array($smsNotifier, 'sendOrderStatus');
//                if($order->customer->email)
//                    $order->onSendTrack = array($emailNotifier, 'sendOrderTrack');

                $event = new CModelEvent($order);
                $order->onSendTrack($event);
            }
        }
    }

    public function actionCdekRegister($id)
    {
        $result = Orders::model()->findByPk($id)->cdekRegister();
        var_dump($result);
    }

    public function actionGlavpunktRegister()
    {
        $ids = Yii::app()->request->getParam('ids');
        if(!is_array($ids))
            $id = array($ids);

        $criteria = new CDbCriteria();
        $criteria->addInCondition('id',$ids);
        $orders = Orders::model()->findAll($criteria);

        $response = Yii::app()->glavpunkt->registerOrder($orders);

        var_dump($response);
    }

    public function actionCdekPrint($id)
    {
        $model = Orders::model()->findByPk($id);
        Yii::app()->CDEKApi->orderPrint($model);
    }

    public function actionEntityDocuments($id){

        $order = Orders::model()->findByPk($id);
        $entity = $order->customer->entityInfo;

        spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import('backend.extensions.PHPExcel.PHPExcel', true);
        spl_autoload_register(array('YiiBase','autoload'));

        $fileName = Yii::getpathOfAlias('backend.www.data') .'/torg12.xls';
        $outPutFileName = 'Товарная накладная'.$id.'.xls';

        $xls = PHPExcel_IOFactory::load($fileName);
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();

        $entityFullSting = $entity->name;
        $entityFullSting .= ', ИНН '. $entity->inn;
        $entityFullSting .= ', '. $entity->address;
        $entityFullSting .= ', Р/С '. $entity->rs;
        $entityFullSting .= ', '. 'в банке '.$entity->bank;
        $entityFullSting .= ', БИК '. $entity->bik;
        if($entity->ks)
            $entityFullSting .= ', К/С '. $entity->ks;

        $sheet->setCellValue('D8', $entity->name.', ИНН '. $entity->inn);
        $sheet->setCellValue('D10', $entity->address);
        $sheet->setCellValue('D14', $entityFullSting);
        $sheet->setCellValue('D16', date('d/m-y',strtotime($order->date)));
        $sheet->setCellValue('AM15', date('d/m-y',strtotime($order->date)));
        $sheet->setCellValue('AM17', date('d.m.Y',strtotime($order->date)));
        $sheet->setCellValue('K19', $order->id);
        $sheet->setCellValue('O19', date('d.m.Y',strtotime($order->date)));
        $sheet->setCellValue('AM3', '330212');

        $orderProducts = $order->products;
        $orderProductsCount = count($orderProducts);
        $orderTotalProducts = $order->getTotal(false);
        $shift = 0;
        $firstSubTotalRow = 25;
        $firstSubTotal = 0;
        $sheetCount = 1;

        for ($i=0; $i< (count($orderProducts) < 2 ? count($orderProducts) : 2); $i++){
                $sheet->insertNewRowBefore($firstSubTotalRow);
                $sheet->mergeCells('C'.$firstSubTotalRow.':F'.$firstSubTotalRow);
                $sheet->mergeCells('H'.$firstSubTotalRow.':K'.$firstSubTotalRow);
                $sheet->mergeCells('N'.$firstSubTotalRow.':P'.$firstSubTotalRow);
                $sheet->mergeCells('Q'.$firstSubTotalRow.':S'.$firstSubTotalRow);
                $sheet->mergeCells('T'.$firstSubTotalRow.':V'.$firstSubTotalRow);
                $sheet->mergeCells('W'.$firstSubTotalRow.':X'.$firstSubTotalRow);
                $sheet->mergeCells('Y'.$firstSubTotalRow.':AA'.$firstSubTotalRow);
                $sheet->mergeCells('AB'.$firstSubTotalRow.':AF'.$firstSubTotalRow);
                $sheet->mergeCells('AG'.$firstSubTotalRow.':AH'.$firstSubTotalRow);
                $sheet->mergeCells('AI'.$firstSubTotalRow.':AK'.$firstSubTotalRow);
                $sheet->mergeCells('AL'.$firstSubTotalRow.':AM'.$firstSubTotalRow);

                $sheet->getStyle('Y'.$firstSubTotalRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $sheet->getStyle('AB'.$firstSubTotalRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $sheet->getStyle('AL'.$firstSubTotalRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $sheet->getStyle('Y'.$firstSubTotalRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('AB'.$firstSubTotalRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('AL'.$firstSubTotalRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);




            $sheet->setCellValue('B'.$firstSubTotalRow, $orderProductsCount-$i);
            $sheet->setCellValue('C'.$firstSubTotalRow, $orderProducts[$i]->title);
            $sheet->setCellValue('H'.$firstSubTotalRow, 'шт');
            $sheet->setCellValue('L'.$firstSubTotalRow, '796');
            $sheet->setCellValue('W'.$firstSubTotalRow, $orderProducts[$i]->count);
            $sheet->setCellValue('Y'.$firstSubTotalRow, $orderProducts[$i]->price);
            $sheet->setCellValue('AB'.$firstSubTotalRow, $orderProducts[$i]->price*$orderProducts[$i]->count);
            $sheet->setCellValue('AG'.$firstSubTotalRow, 'Без НДС');
            $sheet->setCellValue('AI'.$firstSubTotalRow, '-');
            $sheet->setCellValue('AL'.$firstSubTotalRow, $orderProducts[$i]->price*$orderProducts[$i]->count);
            $firstSubTotal += $orderProducts[$i]->price*$orderProducts[$i]->count;
            $shift++;
        }

        $sheet->getStyle('AL'.($firstSubTotalRow+$shift))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        $sheet->setCellValue('AI'.($firstSubTotalRow+$shift), '-');
        $sheet->setCellValue('AL'.($firstSubTotalRow+$shift), $firstSubTotal);

        if($orderProductsCount > 2){
            $sheet->setBreak( 'A'.($firstSubTotalRow+$shift) , PHPExcel_Worksheet::BREAK_ROW );
            $sheet->removeRow($firstSubTotalRow+$shift+1,1);
            $secondSubTotalRow = $firstSubTotalRow+$shift+6;
            $secondSubTotal = 0;
            $shift = 0;

            for ($i=2; $i< count($orderProducts); $i++){
                $sheet->insertNewRowBefore($secondSubTotalRow);
                $sheet->mergeCells('C'.$secondSubTotalRow.':F'.$secondSubTotalRow);
                $sheet->mergeCells('H'.$secondSubTotalRow.':K'.$secondSubTotalRow);
                $sheet->mergeCells('N'.$secondSubTotalRow.':P'.$secondSubTotalRow);
                $sheet->mergeCells('Q'.$secondSubTotalRow.':S'.$secondSubTotalRow);
                $sheet->mergeCells('T'.$secondSubTotalRow.':V'.$secondSubTotalRow);
                $sheet->mergeCells('W'.$secondSubTotalRow.':X'.$secondSubTotalRow);
                $sheet->mergeCells('Y'.$secondSubTotalRow.':AA'.$secondSubTotalRow);
                $sheet->mergeCells('AB'.$secondSubTotalRow.':AF'.$secondSubTotalRow);
                $sheet->mergeCells('AG'.$secondSubTotalRow.':AH'.$secondSubTotalRow);
                $sheet->mergeCells('AI'.$secondSubTotalRow.':AK'.$secondSubTotalRow);
                $sheet->mergeCells('AL'.$secondSubTotalRow.':AM'.$secondSubTotalRow);

                $sheet->getStyle('Y'.$secondSubTotalRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $sheet->getStyle('AB'.$secondSubTotalRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $sheet->getStyle('AL'.$secondSubTotalRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $sheet->getStyle('Y'.$secondSubTotalRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('AB'.$secondSubTotalRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('AL'.$secondSubTotalRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $sheet->setCellValue('B'.$secondSubTotalRow, $orderProductsCount-$i);
                $sheet->setCellValue('C'.$secondSubTotalRow, $orderProducts[$i]->title);
                $sheet->setCellValue('H'.$secondSubTotalRow, 'шт');
                $sheet->setCellValue('L'.$secondSubTotalRow, '796');
                $sheet->setCellValue('W'.$secondSubTotalRow, $orderProducts[$i]->count);
                $sheet->setCellValue('Y'.$secondSubTotalRow, $orderProducts[$i]->price);
                $sheet->setCellValue('AB'.$secondSubTotalRow, $orderProducts[$i]->price*$orderProducts[$i]->count);
                $sheet->setCellValue('AG'.$secondSubTotalRow, 'Без НДС');
                $sheet->setCellValue('AI'.$secondSubTotalRow, '-');
                $sheet->setCellValue('AL'.$secondSubTotalRow, $orderProducts[$i]->price*$orderProducts[$i]->count);
                $secondSubTotal += $orderProducts[$i]->price*$orderProducts[$i]->count;
                $shift++;
            }
            $sheet->getStyle('AL'.($secondSubTotalRow+$shift))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle('AL'.($secondSubTotalRow+$shift))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $sheet->setCellValue('AI'.($secondSubTotalRow+$shift), '-');
            $sheet->setCellValue('AL'.($secondSubTotalRow+$shift), $secondSubTotal);
            $shift++;
        }else{
            $secondSubTotalRow = $firstSubTotalRow;
            $sheet->removeRow($firstSubTotalRow+$shift+2,7);
            $shift++;
        }
        $sheet->getStyle('AL'.($secondSubTotalRow+$shift))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('AL'.($secondSubTotalRow+$shift))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $sheet->setCellValue('AI'.($secondSubTotalRow+$shift), '-');
        $sheet->setCellValue('AL'.($secondSubTotalRow+$shift), $orderTotalProducts);


        $sheet->setCellValue('F'.($secondSubTotalRow+$shift+2), SHtml::num2list($orderProductsCount));
        $sheet->setCellValue('B'.($secondSubTotalRow+$shift+12), SHtml::num2str($orderTotalProducts));
        $sheet->setCellValue('F'.($secondSubTotalRow+$shift+21), '"'.date('d',strtotime($order->date)).'"');
        $sheet->setCellValue('G'.($secondSubTotalRow+$shift+21), SHtml::russian_month(date('m',strtotime($order->date))));
        $sheet->setCellValue('I'.($secondSubTotalRow+$shift+21), date('Y',strtotime($order->date)).' года');



        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=".$outPutFileName);

// Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
    }

    public function actionEntityInvoice($id){

        $order = Orders::model()->findByPk($id);
        $customer = $order->customer;
        $entity = $order->customer->entityInfo;

        spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import('backend.extensions.PHPExcel.PHPExcel', true);
        spl_autoload_register(array('YiiBase','autoload'));

        $fileName = Yii::getpathOfAlias('backend.www.data') .'/schet_faktura.xls';
        $outPutFileName = 'Счет-фактура'.$id.'-1.xls';

        $xls = PHPExcel_IOFactory::load($fileName);
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();


        $sheet->setCellValue('AS6', $order->id.'/1');
        $sheet->setCellValue('BF6', date('d',strtotime($order->date)));
        $sheet->setCellValue('BN6',SHtml::russian_month(date('m',strtotime($order->date))).' '.date('Y',strtotime($order->date)).' года');

        $sheet->setCellValue('AE13', $entity->name.', '.$entity->address);
        $sheet->setCellValue('AS14', $entity->id);
        $sheet->setCellValue('BJ14', date('d.m.Y', strtotime($order->date)));
        $sheet->setCellValue('J16', $entity->address);
        $sheet->setCellValue('X17', $entity->inn.'/'.$entity->kpp);

        $orderProducts = $order->products;
        $orderProductsCount = count($orderProducts);
        $row = 23;
        $total = 0;

        foreach($orderProducts as $product){
            $sheet->insertNewRowBefore($row);
            $sheet->mergeCells('A'.$row.':V'.$row);
            $sheet->mergeCells('W'.$row.':Z'.$row);
            $sheet->mergeCells('AA'.$row.':AN'.$row);
            $sheet->mergeCells('AO'.$row.':AV'.$row);
            $sheet->mergeCells('AW'.$row.':BG'.$row);
            $sheet->mergeCells('BH'.$row.':BV'.$row);
            $sheet->mergeCells('BW'.$row.':CF'.$row);
            $sheet->mergeCells('CG'.$row.':CQ'.$row);
            $sheet->mergeCells('CR'.$row.':DC'.$row);
            $sheet->mergeCells('DD'.$row.':DV'.$row);
            $sheet->mergeCells('DW'.$row.':EF'.$row);
            $sheet->mergeCells('EG'.$row.':ES'.$row);
            $sheet->mergeCells('ET'.$row.':FE'.$row);
            $sheet->getStyle('AW'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $sheet->getStyle('BH'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $sheet->getStyle('DD'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

            $sheet->setCellValue('A'.$row, $product->title);
            $sheet->setCellValue('W'.$row, 796);
            $sheet->setCellValue('AA'.$row, 'шт');


            $sheet->setCellValue('AO'.$row, $product->count);
            $sheet->setCellValue('AW'.$row, $product->price);
            $sheet->setCellValue('BH'.$row, $product->price*$product->count);
            $sheet->setCellValue('BW'.$row, 'Без акциза');
            $sheet->setCellValue('CG'.$row, 'X');
            $sheet->setCellValue('CR'.$row, 'X');
            $sheet->setCellValue('DD'.$row, $product->price*$product->count);
            $sheet->setCellValue('DW'.$row, '-');
            $sheet->setCellValue('EG'.$row, '-');
            $sheet->setCellValue('ET'.$row, '-');
            $total += $product->price*$product->count;
        }
        $sh = $orderProductsCount + $row;
        $sheet->setCellValue('BH'.$sh, $total);
        $sheet->setCellValue('CR'.$sh, 'X');
        $sheet->setCellValue('DD'.$sh, $total);


        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=".$outPutFileName);

// Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
    }

    public function actionCourierShippingRegister(){
        spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import('backend.extensions.PHPExcel.PHPExcel', true);
        spl_autoload_register(array('YiiBase','autoload'));

        $fileName = Yii::getpathOfAlias('backend.www.data') .'/courier_shipping.xls';
        $outPutFileName = 'CourierShipping_'.date('d-m-Y').'.xls';

        $xls = PHPExcel_IOFactory::load($fileName);
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();

        $orders = Orders::model()->findAll(SHtml::getAllOrdersCriteria());

        $startShiftRow = 8;
        foreach($orders as $key=>$order) {
            $orderCustomer = $order->customer;
            $orderCustomerAddress = $orderCustomer->address;

            $row = $startShiftRow+5*$key;

            $sheet->setCellValue("E".$row, $orderCustomerAddress->city.', '.$orderCustomerAddress->getFullCityAddress());
            $sheet->setCellValue("E".($row+1), $orderCustomer->name);
            $sheet->setCellValue("E".($row+2), $orderCustomer->phone);

            $sheet->setCellValue("G".$row, $order->getWeight('kg'));
            $sheet->setCellValue("H".$row, '1');

            $sheet->setCellValue("I".($row+1), $order->id);
            $sheet->setCellValue("J".$row, date('d.m.Y'));
            $sheet->setCellValue("K".$row, '07:00 - 12:00');
            $orderShippingData = explode(' / ',$order->comment);
            $sheet->setCellValue("L".$row, $orderShippingData[0]);
            $sheet->setCellValue("M".$row, $orderShippingData[1]);
            $sheet->setCellValue("U".$row, $order->payment_status == OrderPaymentStatus::PAID ? 0 : $order->total);
        }

        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=".$outPutFileName);

// Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
    }

    public function actionEntityContract($id){
        $order = Orders::model()->findByPk($id);

        $mPDF1 = Yii::app()->ePdf->mpdf();
        $stylesheet = file_get_contents(Yii::getPathOfAlias('backend.www.css') . '/print.css');
        $mPDF1->WriteHTML($stylesheet, 1);

        $footer = array (
            'odd' => array (
                'L' => array (
                    'content' => '_______________ Поставщик',
                    'font-size' => 8,
                    'font-family' => 'serif',
                    'color'=>'#ссс'
                ),
                'R' => array (
                    'content' => '_______________ Покупатель',
                    'font-size' => 8,
                    'font-family' => 'serif',
                    'color'=>'#ссс'
                )
            ),
            'even' => array (
                'L' => array (
                    'content' => '_______________ Поставщик',
                    'font-size' => 8,
                    'font-family' => 'serif',
                    'color'=>'#ссс'
                ),
                'R' => array (
                    'content' => '_______________ Покупатель',
                    'font-size' => 8,
                    'font-family' => 'serif',
                    'color'=>'#ссс'
                )
            )
        );

        $mPDF1->SetFooter($footer);

        $mPDF1->AddPage();
        $mPDF1->WriteHTML($this->renderPartial('//print/contract', array(
            'order' => $order,
            'entity' => $order->customer->entityInfo
        ), true));

        $mPDF1->Output();
    }

    public function actionGetPRFList(){
        spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import('backend.extensions.PHPExcel.PHPExcel', true);
        spl_autoload_register(array('YiiBase','autoload'));

        $outPutFileName = 'PRF_LIST_'.date('d-m-Y');

//        $xls = new PHPExcel();
        $fileName = Yii::getpathOfAlias('backend.www.data') .'/prf_list.xls';
        $xls = PHPExcel_IOFactory::load($fileName);
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();
        $sheet->setTitle('p0');


        $orders = Orders::model()->findAll(SHtml::getAllOrdersCriteria());
        $page = 0;
        $startStroke = 23;

        foreach($orders as $key=>$order) {
            $number = $key+1;
            $row = $startStroke + $number - $page*10;

            $orderCustomer = $order->customer;
            $orderCustomerAddress = $orderCustomer->address;
            $address =
                $orderCustomer->name.'; '.
                $orderCustomerAddress->zip.', '.
                ($orderCustomerAddress->area != $orderCustomerAddress->city ?  $orderCustomerAddress->area : ''). ', '.
                $orderCustomerAddress->city. ', '.
                $orderCustomerAddress->address;



            $sheet->setCellValue("B".$row, $key+1);
            $sheet->setCellValue("C".$row, $address);

            if($number % 10 == 0){
                $page++;

                $newSheet = clone $xls->getSheetByName('p0');
                $newSheet->setTitle('p'.$page);
                $newSheetIndex = $page;
                $xls->addSheet($newSheet,$newSheetIndex);
                $xls->setActiveSheetIndex($newSheetIndex);
                $sheet = $xls->getActiveSheet();
            }
        }

        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=".$outPutFileName.'_p'.$page.'.xls');

// Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
    }

    public function actionInvoice($id){
        $this->renderPartial('invoice', array(
            'order' => Orders::model()->findByPk($id)
        ));
    }

    public function actionFastView(){
        if(Yii::app()->request->isPostRequest){
            $model = Orders::model()->findByPk($_POST['id']);
            $this->renderPartial('fastView',array(
                'model' => $model,
                'customer' => $model->customer,
                'customerAddress'=> $model->customerAddress
            ));
        }
    }

    public function actionSetStatus(){
        if(Yii::app()->request->isAjaxRequest){
            if(isset($_POST['status'])){
                $callback = Orders::model()->findByPk($_POST['id']);
                $callback->status = $_POST['status'];
                $callback->save();
                echo 'ok';
            }
        }

        Yii::app()->end();
    }

    public function actionSendSms(){
        if(isset($_POST['order_id']) && isset($_POST['text']) && !empty($_POST['text'])){
            SmsNotifier::managerNotification(Orders::model()->findByPk($_POST['order_id']), $_POST['text']);
            echo 'ok';
        }
    }

    public function actionSendMail(){
        if(isset($_POST['order_id']) && isset($_POST['text']) && !empty($_POST['text'])){
            EmailNotifier::managerNotification(Orders::model()->findByPk($_POST['order_id']), nl2br($_POST['text']."\n".Yii::app()->user->model->signature));
            echo 'ok';
        }
    }


}
