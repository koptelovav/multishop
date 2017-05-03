<?php

class SiteController extends FrontEndController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionIndex()
    {
        $this->render('index');
    }


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $message = new YiiMailMessage;
                $message->setBody($model->body, 'text/html');
                $message->subject = $model->subject;
                $message->addTo('manager@bamboogroup.ru');
                $message->from = $model->email;
                Yii::app()->mail->send($message);
                Yii::app()->user->setFlash('contact', 'Ваше письмо, успешно отправлено!');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionSitemap(){
        $dom = new DOMDocument("1.0",'UTF-8');
        $root = $dom->createElement("urlset");
        $root->setAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
        $dom->appendChild($root);

       /* foreach (Yii::app()->shop->category as $category) {
            $url = $dom->createElement("url");
            $loc = $dom->createElement("loc", Yii::app()->createAbsoluteUrl('category/view', array('cid'=>$category->id)));
            $url->appendChild($loc);
            $root->appendChild($url);
        }*/

        foreach (Yii::app()->shop->products as $product) {
                $url = $dom->createElement("url");
                $loc = $dom->createElement("loc", PHtml::url($product, true));
            $lastMod = $dom->createElement("lastmod", date('Y-m-d',strtotime($product->updated)));
//            echo  PHtml::url($product, true).'<br>';
                $url->appendChild($loc);
                $url->appendChild($lastMod);
                $root->appendChild($url);
        }

        header('Content-type: text/xml');
        echo $dom->saveXML();

        Yii::app()->end();
    }

    public function actionRobots()
    {
        $domain = Yii::app()->shop->domain;
        if(Yii::app()->shop->id == 7)
            $domain = 'muwu.ru';

        $robotsTXT = <<<EOF
Host: $domain
User-agent: *
Disallow: /billing/success
Disallow: /billing/fail
Disallow: /cart
Disallow: /cart/add
Disallow: /css/
Disallow: /cgi-bin/
Disallow: /images/

Allow: /
Sitemap: http://$domain/sitemap.xml
EOF;
    echo $robotsTXT;
    }

    public function actionCalculateShipping(){
        if($_REQUEST['zip']){
            $data['weight'] = 3;
            $shippingVariants = Yii::app()->shippingCalculator->calculate(Shipping::TYPE_RUS,$_REQUEST['zip'],1000,$data['weight'], array());
            $result = array();
            foreach(Shipping::model()->findAll() as $item){
                if(isset($shippingVariants[$item->edost_code])){
                    $item->price = $shippingVariants[$item->edost_code]['price'];
                    $item->times = !empty($shippingVariants[$item->edost_code]['day']) ? $shippingVariants[$item->edost_code]['day'] : '-';
                    $result[] = $item;
                }
            }

            $this->renderPartial('_shipping_variants',array(
                'shippingVariants'=>$result
            ));
        }
    }
}