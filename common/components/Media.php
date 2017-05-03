<?php
class Media extends CApplicationComponent{

    public $baseUrl;
    public $basePath;
    public $webroot;

    public function init(){
        $this->basePath = Yii::getPathOfAlias('media');
        $this->webroot= $this->basePath.DIRECTORY_SEPARATOR.'www';
//        $this->baseUrl = '//media.'.str_replace(array('www.','admin.', 'a.'),'',$_SERVER['SERVER_NAME']);
//        $this->baseUrl = str_replace('kineticsandbuild','muwu', $this->baseUrl);
 //       $this->baseUrl = 'http://media.blackbamboo.local';
        $this->baseUrl = 'http://media.blackbamboo.local';
    }
}