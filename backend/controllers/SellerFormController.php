<?php

class SellerFormController extends BackEndController
{
    public $pageTitle = 'Бланк кассира';
    public $controllerModelName = 'SellerForm';

    public function actionIndex()
    {
        $date = isset($_GET['d']) ? $_GET['d'] : date('d-m-Y');
        $currentShift = SellerForm::model()->find('DATE_FORMAT(date,"%d-%m-%Y") = :date', array(':date' => $date));

        if (!$currentShift) {
            $this->redirect('sellerForm/create');
            Yii::app()->end();
        }

        $sales = new SellerFormSale();
        $sales->seller_form_id = $currentShift->id;
        $this->render('index', array(
            'model' => $currentShift,
            'sales' => $sales
        ));
    }

    public function actionCreate()
    {
        $model = new $this->controllerModelName;
        $this->form($model);
    }

    public function actionNewSale()
    {
        $model = new SellerFormSale();
        if(isset($_POST['SellerFormSale']))
        {

            $model->attributes=$_POST['SellerFormSale'];
            $model->seller_form_id= SellerForm::model()->find('DATE_FORMAT(date,"%d-%m-%Y") = :date', array(':date' => date('d-m-Y')))->id;
            $model->isNewRecord = !$model->id;

            $text = $model->isNewRecord ? "Запись успешно ДОБАВЛЕНА" : "Запись успешно ИЗМЕНЕНА";

            if($model->save()){
                $this->writeOff($model->id);
                Yii::app()->user->setFlash('success', $text);
                echo 'ok';
            }

            else{
                $errorMsg = '';
                foreach($model->errors as $error){
                    $errorMsg .= $error[0]."\n";
                }
                echo $errorMsg;
            }
        }
    }

    public function actionWriteOff($id){
        $this->writeOff($id);
    }

    public function writeOff($id){
        $request = array();
        $sale = SellerFormSale::model()->findByPk($id);

        if($sale->product_id){
            $product = Products::model()->findByPk($sale->product_id);
            if($product->type == Products::TYPE_SET){
                $productInclude = $product->product_include;
                foreach ($productInclude as $item) {
                    $request[] = array(
                        'product_id' => $item->include_id,
                        'store_id' => StoreApi::STORE_KOMENDANTSKI,
                        'account_id' => StoreApi::$payment_to_account_store[$sale->payment_type],
                        'product_price' => $item->product->price,
                        'discount' => $sale->discount ? $sale->discount : 0,
                        'product_count' => $sale->product_count*$item->count,
                        'note' => 'Продажа № '.$sale->id,
                        'uid' => 'S'.$sale->id
                    );
                }
            }

            else {
                $request[] = array(
                    'product_id' => $sale->product_id,
                    'store_id' => StoreApi::STORE_KOMENDANTSKI,
                    'account_id' => StoreApi::$payment_to_account_store[$sale->payment_type],
                    'product_price' => $sale->product_price,
                    'discount' => $sale->discount ? $sale->discount : 0,
                    'product_count' => $sale->product_count,
                    'note' => 'Продажа № '.$sale->id,
                    'uid' => 'S'.$sale->id
                );
            }
        }

        if($sale->gift_id){
            $request[] = array(
                'product_id' => $sale->gift_id,
                'store_id' => StoreApi::STORE_KOMENDANTSKI,
                'account_id' => StoreApi::ACCOUNT_AVANGARD,
                'product_price' => 0,
                'discount' => 0,
                'product_count' => $sale->product_count,
                'note' => 'Продажа № '.$sale->id,
                'uid' => 'S'.$sale->id
            );
        }

        Yii::app()->store->sale($request);
    }

    public function actionNewExpense()
    {
        $model = new SellerFormExpense();
        if(isset($_POST['SellerFormExpense']))
        {

            $model->attributes=$_POST['SellerFormExpense'];
            $model->seller_form_id= SellerForm::model()->find('DATE_FORMAT(date,"%d-%m-%Y") = :date', array(':date' => date('d-m-Y')))->id;

            if($model->save()){
                echo 'ok';
            }

            else{
                $errorMsg = '';
                foreach($model->errors as $error){
                    $errorMsg .= $error[0]."\n";
                }
                echo $errorMsg;
            }
        }
    }

    public function actionSuggest(){
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = Products::model()->findAll(array(
                'condition' => 'title LIKE :keyword',
                'params' => array(
                    ':keyword' => '%' . strtr($_GET['term'], array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
                )
            ));
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'id' => $m->id,
                    'price' => $m->getPrice(),
                    'label' => $m->short_title,
                    'value' => $m->title,
                );

            echo CJSON::encode($result);
        }
    }

    public function actionDeleteSale(){
        $model = SellerFormSale::model()->findByPk($_POST['id']);
        if($model->delete()){
            Yii::app()->user->setFlash('success', "Запись успешно УДАЛЕНА");
            echo 'ok';
        }

        else{
            $errorMsg = '';
            foreach($model->errors as $error){
                $errorMsg .= $error[0]."\n";
            }
            echo $errorMsg;
        }
    }

    public function actionPayrollPreparation(){
        $this->render('payrollPreparation', array(

        ));
    }

    public function actionPrint(){

        $date = isset($_GET['d']) ? $_GET['d'] : date('d-m-Y');
        $currentShift = SellerForm::model()->find('DATE_FORMAT(date,"%d-%m-%Y") = :date', array(':date' => $date));

        $sales = new SellerFormSale();
        $sales->seller_form_id = $currentShift->id;


        $mPDF1 = Yii::app()->ePdf->mpdf();
        $stylesheet = file_get_contents(Yii::getPathOfAlias('backend.www.css') . '/print.css');
        $mPDF1->WriteHTML($stylesheet, 1);


        $mPDF1->AddPage('L');
        $mPDF1->WriteHTML($this->renderPartial('print', array(
            'model' => $currentShift,
            'sales' => $sales
        ), true));

        $mPDF1->Output();
    }
}
