<?php
class ReviewController extends FrontEndController{


    public function actionIndex(){
        $page = $_GET['page'] ? ($_GET['page']-1) * 20: 0;
        $response = Yii::app()->vk->api('board.getComments', array('group_id'=>'57874883', 'topic_id'=>'29726682', 'extended'=>'1', 'offset'=> $page, 'sort'=>'desc'));
        if(!isset($response['error'])){
//            var_export($response);
            $data = $response['response'];

            $pages = new CPagination($data['count']);
            $pages->setPageSize(20);

            $dataProvider = new CArrayDataProvider($data['items'],
                array(
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                ));

            $pages = new CPagination($data['count']);
            $pages->setPageSize(20);

            $this->render('vk', array(
                'dataProvider'=>$dataProvider,
                'response'=>$data,
                'pages' => $pages
            ));
        }
    }
} 