<?php

class BackEndController extends BaseController
{

    public $layout = '//layouts/panel';

    public $menu = array();

    // крошки
    public $breadcrumbs = array();

    public $panelTitle;
    public $panelButtons = array();

    public $buttonIndexTemplate = '{add} {copy} {delete}';
    public $buttonViewTemplate = '{edit} {return}';
    public $buttonEditTemplate = '{save} {apply} {return}';
    public $buttonCurrentTemplate = '';
    public $buttonCustomTemplate = '';

    public $controllerModelName;

    public function init(){
        $this->initPanelButtons();
        parent::init();
    }

    public function getPanelButtons(){
        $buttonTemplate = $this->buttonCurrentTemplate.$this->buttonCustomTemplate;
        foreach($this->panelButtons as $id=>$button){
            if(strpos($buttonTemplate,'{'.$id.'}')===false)
                unset($this->panelButtons[$id]);
        }

        return $this->panelButtons;
    }

    public function initPanelButtons(){
        $this->panelButtons['add'] = CHtml::link('Добавить', $this->createUrl('create'),array('class' => 'btn btn-primary btn-xs ', 'name' => 'create'));
        $this->panelButtons['apply'] = CHtml::submitButton('Применить', array('class' => 'btn btn-primary btn-xs', 'name' => 'apply', 'id'=>'panel-apply'));
        $this->panelButtons['save'] = CHtml::submitButton('Сохранить', array('class' => 'btn btn-success btn-xs', 'name' => 'save', 'id'=>'panel-save'));
        $this->panelButtons['copy'] = CHtml::link('Копировать', $this->createUrl('copy', array('id'=>Yii::app()->request->getParam('id'))),array('class' => 'btn btn-primary btn-xs ask', 'name' => 'copy'));
        $this->panelButtons['edit'] = CHtml::link('Редактировать', $this->createUrl('update'),array('class' => 'btn btn-primary btn-xs', 'name' => 'update'));
        $this->panelButtons['return'] = CHtml::link('Вернуться', '#',array('class' => 'btn btn-primary btn-xs', 'name' => 'index', 'onclick'=>'window.history.go(-1); return false;'));
        $this->panelButtons['delete'] = CHtml::link('Удалить', $this->createUrl('delete', array('id'=>Yii::app()->request->getParam('id'))),array('class' => 'btn btn-delete btn-danger btn-xs', 'name' => 'delete', 'data-redirect'=>$this->createUrl($this->defaultAction)));
    }

    public function addButton($params){
        $this->panelButtons[$params['name']] = CHtml::link($params['label'], $this->createUrl($params['route']),
            array_merge(array('class' => 'btn btn-primary btn-xs', 'name' => $params['name']), isset($params['options']) ? $params['options']: array()));
        $this->buttonCustomTemplate .= '{'.$params['name'].'}';
    }

    //template CRUD
    public function actionIndex()
    {
        $this->buttonCurrentTemplate = $this->buttonIndexTemplate;

        $model=new $this->controllerModelName;
        $model->setScenario('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$this->controllerModelName]))
            $model->attributes=$_GET[$this->controllerModelName];

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    protected function form($model){
        if(isset($_POST[$this->controllerModelName]))
        {
            $model->attributes=$_POST[$this->controllerModelName];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('form',array(
            'model'=>$model,
        ));
    }
    public function actionCreate()
    {
        $this->buttonCurrentTemplate = $this->buttonEditTemplate;
        $model=new $this->controllerModelName;
        $this->form($model);
    }

    public function actionUpdate($id)
    {
        $this->buttonCurrentTemplate = $this->buttonEditTemplate;
        $model=$this->loadModel($id);
        $this->form($model);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function loadModel($id)
    {
        $model= call_user_func(array($this->controllerModelName, 'model'))->resetScope()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}