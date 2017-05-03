<?php
class BlockVideoWidget extends CWidget{
    public $identifier;

    public function run(){
        $block = Block::model()->findByAttributes(array(
            'identifier' => $this->identifier
        ));
        if($block){


            $this->render('view',array(
                'videos' => $block->videos,
                'block' => $block,
                'identifier' => strtolower($this->identifier)
            ));
        }

    }
}