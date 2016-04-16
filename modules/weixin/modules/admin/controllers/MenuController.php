<?php

namespace app\modules\weixin\modules\admin\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;

use app\modules\weixin\models\WeixinMenu;
use app\modules\weixin\models\Weixin;

class MenuController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $menu = Yii::$app->settings->get('weixin', 'menu');
        $menuLastModify = Yii::$app->settings->get('weixin', 'menuLastModify');

        return $this->render('index', [
            'menu' => $menu,
            'menuLastModify' => $menuLastModify
        ]);
    }

    public function actionSave()
    {
        if(Yii::$app->request->isPost){
            $postdata = file_get_contents("php://input");
            $post = json_decode($postdata, true);

            $menu = $post['menus'];

            Yii::$app->settings->set('weixin', 'menu', json_encode($menu), 'string');
            Yii::$app->settings->set('weixin', 'menuLastModify', time(), 'integer');

            $menus = $this->menuBuildMenuSet($menu);

            $app = Weixin::getApplication();
            foreach ($menus as $button) {
                $app->menu->add($button);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['result' => 0];
        }
    }

    public function actionDelete()
    {
        if(Yii::$app->request->isPostRequest)
        { 
            if($this->weObj->deleteMenu()){
                Yii::$app->settings->set('system', 'weixinMenu', array());

                $this->renderJSON('success');
            }

            $this->renderJSON(array('message'=>$this->weObj->errMsg));
        }
    }

    private function menuBuildMenuSet($menu) {
        $types = array(
            'view', 'click', 'scancode_push', 
            'scancode_waitmsg', 'pic_sysphoto', 'pic_photo_or_album', 
            'pic_weixin', 'location_select'
        );
        $set = array();
        $set['button'] = array();
        foreach($menu as $m) {
            $entry = array();
            $entry['name'] = $m['title'];
            if(!empty($m['subMenus'])) {
                $entry['sub_button'] = array();
                foreach($m['subMenus'] as $s) {
                    $e = array();
                    if ($s['type'] == 'url') {
                        $e['type'] = 'view';
                    } elseif (in_array($s['type'], $types)) {
                        $e['type'] = $s['type'];
                    } else {
                        $e['type'] = 'click';
                    }
                    $e['name'] = $s['title'];
                    if($e['type'] == 'view') {
                        $e['url'] = $s['url'];
                    } else {
                        $e['key'] = urlencode($s['forward']);
                    }
                    $entry['sub_button'][] = $e;
                }
            } else {
                if ($m['type'] == 'url') {
                    $entry['type'] = 'view';
                } elseif (in_array($m['type'], $types)) {
                    $entry['type'] = $m['type'];
                } else {
                    $entry['type'] = 'click';
                }
                if($entry['type'] == 'view') {
                    $entry['url'] = $m['url'];
                } else {
                    $entry['key'] = urlencode($m['forward']);
                }
            }
            $set['button'][] = $entry;
        }
        return $set;
    }
}
