<?php
/**
 * Created by JetBrains PhpStorm.
 * User: z_bodya
 * Date: 6/20/12
 * Time: 7:41 PM
 * To change this template use File | Settings | File Templates.
 */
class ElFinderBrowserWidget extends CWidget
{
    /**
     * Client settings.
     * More about this: https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
     * @var array
     */
    public $settings = array();
    public $connectorRoute = false;
    private $assetsDir;


    public function init()
    {

        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);
        $cs = Yii::app()->getClientScript();

        if (Yii::app()->getRequest()->enableCsrfValidation) {
            $csrfTokenName = Yii::app()->request->csrfTokenName;
            $csrfToken = Yii::app()->request->csrfToken;
            Yii::app()->clientScript->registerMetaTag($csrfToken, 'csrf-token');
            Yii::app()->clientScript->registerMetaTag($csrfTokenName, 'csrf-param');
        }

        // jQuery and jQuery UI
        $cs->registerCssFile($cs->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');

        // elFinder CSS
        $cs->registerCssFile($this->assetsDir . '/css/elfinder.css');

        // elFinder JS
            $cs->registerScriptFile($this->assetsDir . '/js/elfinder.full.js');
        // elFinder translation
        $cs->registerScriptFile($this->assetsDir . '/js/i18n/elfinder.ru.js');

        // set required options
        if (empty($this->connectorRoute))
            throw new CException('$connectorRoute must be set!');
        $this->settings['url'] = Yii::app()->createUrl($this->connectorRoute);
        $this->settings['lang'] = Yii::app()->language;

       /* $this->settings['editorCallback'] = 'js:function(url) {
        var path = url.replace("'.Yii::app()->media->baseUrl.'","");
        var num = $("#images-browser img").length;
        $("#images-browser").append("<div>"+
        "<input data-num=\""+num+"\" name=\"Images_general\" type=\"radio\" value=\""+num+"\">"+
        "<img data-num=\""+num+"\" src=\""+url+"\">"+
        "<input data-num=\""+num+"\" name=\"Images["+num+"][name]\" type=\"hidden\" value=\""+path+"\">"+
        "<textarea data-num=\""+num+"\" name=\"Images["+num+"][description]\" cols=\"50\" rows=\"5\"></textarea></div>"
        )
        }';*/
        $baseUrl = Yii::app()->media->baseUrl;
        $this->settings['editorCallback'] = <<<MARK
js:function(tmb,url) {
var path = url.replace("$baseUrl","");
var num = $("#images-browser img").length;
$("#images-browser").append("<div class='item'>"+
"<input data-num="+num+" name='Images["+num+"][url]' type='hidden' value="+path+">"+

"<img class='product-image' data-num="+num+" src="+tmb+">"+
"<div class='hidden-info' data-num="+num+">"+
"<div class='form-group'>"+
"<label class='col-lg-2 control-label'>Размещение</label>"+
"<div class='col-lg-10'>"+
"<select data-num="+num+" name='Images["+num+"][type]'>"+
"<option value='2'>Дополнительное</option>"+
"<option value='1'>Основное</option>"+
"</select>"+
"</div></div>"+

"<div class='form-group'>"+
"<label class='col-lg-2 control-label'>Alt</label>"+
"<div class='col-lg-10'>"+
"<input data-num="+num+" name='Images["+num+"][alt]' type='text' size='60'>"+
"</div></div>"+


"<div class='form-group'>"+
"<label class='col-lg-2 control-label'>Title</label>"+
"<div class='col-lg-10'>"+
"<input data-num="+num+" name='Images["+num+"][title]' type='text' size='60'>"+
"</div></div>"+

"<div class='form-group'>"+
"<label class='col-lg-2 control-label'>Описание</label>"+
"<div class='col-lg-10'>"+
"<textarea data-num="+num+" name='Images["+num+"][description]' cols='60' rows='5'></textarea>"+
"</div></div>"+

"</div></div>"
)
}
MARK;
        $this->settings['closeOnEditorCallback'] = false;
    }

    public function run()
    {
        $id = $this->getId();
        $settings = CJavaScript::encode($this->settings);
        $cs = Yii::app()->getClientScript();
        $cs->registerScript("elFinder#$id", "$('#$id').elfinder($settings);");
        echo "<div id=\"$id\"></div>";
    }

}
