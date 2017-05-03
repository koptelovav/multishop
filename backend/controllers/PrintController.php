<?php

class PrintController extends BackEndController
{
    public function actionAllOrderDocuments(){
        $this->buttonCurrentTemplate = '{add}';

        if($_GET['picker']){
            $criteria = new CDbCriteria();
            $criteria->compare('status',10);
            $criteria->order = 'priority DESC, date ASC';
        }else{
            $criteria = SHtml::getAllOrdersCriteria();
        }
            
        $orders = Orders::model()->findAll($criteria);

        $mPDF1 = Yii::app()->ePdf->mpdf();
        $stylesheet = file_get_contents(Yii::getPathOfAlias('backend.www.css') . '/print.css');
        $mPDF1->WriteHTML($stylesheet, 1);

        foreach($orders as $order){
            $mPDF1->AddPage();
            $mPDF1->WriteHTML($this->renderPartial('cashmemo2', array(
                'model' => $order
            ), true));
            $mPDF1->WriteHTML($this->renderPartial('builder_list', array(
                'model' => $order
            ), true));

            $mPDF1->AddPage();
            $mPDF1->WriteHTML($this->renderPartial('cashmemo', array(
                'model' => $order
            ), true));

            switch($order->shipping_id){
                case Shipping::POST_SHIPPING:
                case Shipping::POST1_SHIPPING:
                    $mPDF1->AddPage();
                    $mPDF1->WriteHTML($this->renderPartial('post_box_label', array(
                        'model' => $order
                    ), true));
                    break;
                case Shipping::COURIER_SHIPPING:
                case Shipping::COURIER_LO_SHIPPING:
                    $mPDF1->AddPage();
                    $mPDF1->WriteHTML($this->renderPartial('box_label', array(
                        'model' => $order
                    ), true));
                    break;

                case Shipping::MSC_DELS_SHIPPING:
                case Shipping::MSC_STORE_SHIPPING:
                case Shipping::CDEK_COURIER_SHIPPING:
                case Shipping::CDEK_STORE_SHIPPING:
                case Shipping::CDEK_SPB:
                    if ($stream = Yii::app()->CDEKApi->orderPrint($order)) {
                        $mPDF1->SetImportUse();
                        $fileName = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $order->id . '.pdf';
                        file_put_contents($fileName, $stream);
                        $pagecount = $mPDF1->SetSourceFile($fileName);

                        for ($i = 1; $i <= $pagecount; $i++) {
                            $mPDF1->AddPage();
                            $import_page = $mPDF1->ImportPage();
                            $mPDF1->UseTemplate($import_page);
                        }
                    }

                    break;

                case Shipping::PEC_STORE_SHIPPING:
                case Shipping::PEC_COURIER_SHIPPING:
                $mPDF1->AddPage();
                $mPDF1->WriteHTML($this->renderPartial('box_label_dl', array(
                    'model' => $order
                ), true));
                break;
                    break;
            }
        }
        # Outputs ready PDF
        $mPDF1->Output();
    }
}
