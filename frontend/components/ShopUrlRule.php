<?php

class ShopUrlRule extends CBaseUrlRule
{
    public function createUrl($manager, $route, $params, $ampersand)
    {
        $otherParams = array();

        if(isset($params['ajax']))
            unset($params['ajax']);
        if(isset($params['undefined']))
            unset($params['undefined']);

        if(isset($params['page'])){
            $otherParams[] = 'page='.$params['page'];
            unset($params['page']);
        }

        if(isset($params['filter'])){
            foreach ($params['filter'] as $key=>$value) {
               if(is_array($value)){
                   foreach ($value as $item) {
                       $otherParams[] = 'filter['.$key.'][]='.$item;
                   }
               }else{
                   $otherParams[] = 'filter['.$key.']='.$value;
               }
            }
            unset($params['filter']);
        }

        if(!empty($otherParams)){
            $url = $this->createUrl($manager, $route, $params, $ampersand);
            $url .= '?'.implode('&',$otherParams);
            return $url;
        }


        if ($route === 'products/view') {
            if(isset($params['id'])){
                $product = Products::model()->findByPk($params['id']);
                if($product){
                    $slug = 'product/';
                    if (isset($params['cid'])){
                        if ($slug = Category::model()->getSlug($params['cid']))
                            $slug = implode('/',$slug).'/';
                    }

                    $slug .= $product->slug;
                    return $slug;
                }

            }
        }

        else if ($route === 'category/view') {

            if (isset($params['cid']))
                if ($slug = Category::model()->getSlug($params['cid'])){
                    $slug = implode('/',$slug);
                    unset($params['cid']);
                    foreach($params as $name=>$value){
                        $slug .= '/'.$name.'-'.$value;
                    }
                    return $slug;
                }

        }

        else if ($route === 'news/view') {

            if (isset($params['id']))
                $news = News::model()->findByPk($params['id']);

                if($news){
                    if ($slug = $news->slug){
                        return 'news/'.$slug;
                    }
                }
        }

        else if ($route === 'gallery/viewAlbum') {

            if (isset($params['id']))
                $album = GalleryAlbum::model()->findByPk($params['id']);

            if($album){
                if ($slug = $album->slug){
                    return 'gallery/'.$slug;
                }
            }
        }

        return false; // не применяем данное правило
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        $redirectUrl = Yii::app()->db->createCommand()
            ->select('url_to')
            ->from('redirection')
            ->where('url_from="'.$pathInfo.'" AND shop_id = '.Yii::app()->shop->id)
            ->queryScalar();

        if($redirectUrl){
            $this->redirect($request, $redirectUrl);
        }


        if(empty($pathInfo))
            return false;

        if(preg_match('(page-(\d))', $pathInfo, $matches)){
            $_GET['page'] = $matches[1];
            $pathInfo = preg_replace('(/page-(\d))','',$pathInfo);
        }

        if(preg_match('(sort-([\w+.\-]*))', $pathInfo, $matches)){
            $_GET['sort'] = $matches[1];
            $pathInfo = preg_replace('(/sort-([\w+.\-]*))','',$pathInfo);
        }


        if ($matches = explode('/',$pathInfo))
        {
            $news = News::model()->findByAttributes(array('slug'=>end($matches)));
            if($news && strcmp($pathInfo, 'news/'.end($matches)) == 0){
                $_GET['id'] = $news->id;
                return 'news/view';
            }
        }

        if ($matches = explode('/',$pathInfo))
        {
            $album = GalleryAlbum::model()->findByAttributes(array('slug'=>end($matches)));
            if($album && strcmp($pathInfo, 'gallery/'.end($matches)) == 0){
                $_GET['id'] = $album->id;
                return 'gallery/viewAlbum';
            }
        }

        if ($matches = explode('/',$pathInfo))
        {
            $category = Category::model()->findByAttributes(array('shop_id'=> Yii::app()->shop->id,'slug'=>end($matches)));
            if($category){
                $_GET['cid'] = $category->id;
                return 'category/view';
            }
        }

        if ($matches = explode('/',$pathInfo))
        {
            $product = Products::model()->findByAttributes(array('slug'=>end($matches)));
            if($product){
                $canonicalUrl = PHtml::url($product);
                if('/'.$pathInfo != $canonicalUrl)
                    $this->redirect($request, $canonicalUrl);

                if(isset($matches[count($matches)-2])){
                    $category = Category::model()->findByAttributes(array('slug'=>$matches[count($matches)-2]));
                    if($category && $category->existProduct($product->id))
                        $_GET['cid'] = $category->id;
                    else if(preg_match('/products/',$matches[count($matches)-2]))
                        return false;
                }
                $_GET['id'] = $product->id;

                return 'products/view';
            }else{
                $category = Category::model()->findByAttributes(array('shop_id'=> Yii::app()->shop->id,'slug'=>end($matches)));
                if($category){
                    $_GET['cid'] = $category->id;
                    return 'category/view';
                }
            }
        }
        return false; // не применяем данное правило
    }

    protected function redirect($request, $redirectUrl){
        if($request->queryString)
            $redirectUrl .= '/?'.$request->queryString;
        $request->redirect($redirectUrl, true, 301);
        Yii::app()->end();
    }

}