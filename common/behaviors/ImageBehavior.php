<?php

class ImageBehavior extends CActiveRecordBehavior
{
    public function getImage($type = Image::TYPE_GENERAL)
    {
        $owner = $this->owner;
        $image = Image::model()->findByAttributes(array(
            'model' => get_class($owner),
            'model_id' => $owner->id,
            'type' => $type
        ));
        if($image)
            return $image->url;
        return false;
    }

    public function getAllImages()
    {
        $owner = $this->owner;
        $images = Image::model()->findAllByAttributes(array(
            'model' => get_class($owner),
            'model_id' => $owner->id,
        ));
        return $images;
    }

    public function getImages()
    {
        $owner = $this->owner;
        $images = Image::model()->findAllByAttributes(array(
            'model' => get_class($owner),
            'model_id' => $owner->id,
            'type' => Image::TYPE_ADDITIONAL
        ));
        return $images;
    }

    public function saveImages($data)
    {
        $owner = $this->owner;

        $oldImages =  $images = Image::model()->findAllByAttributes(array(
            'model' => get_class($owner),
            'model_id' => $owner->id,
        ));

        foreach ($oldImages as $item)
            $item->delete();

        foreach ($data as $key=>$item){
            $image = new Image();
            $image->attributes = $item;
            $image->model = get_class($owner);
            $image->model_id = $owner->id;
            $image->save();
        }
        return true;
    }
}