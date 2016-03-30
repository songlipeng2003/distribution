<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;

use Pingpp\Pingpp;
use Pingpp\Event;
use Pingpp\Charge;

class PingxxController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * pingxx webhook
     */
    public function actionWebHook()
    {
        Pingpp::setApiKey($_ENV['PINGXX_APIKEY']);

        $event = json_decode(file_get_contents("php://input"));

        // 对异步通知做处理
        if (!isset($event->type)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            exit("fail");
        }

        $event = Event::retrieve($event->id);

        if(!$event){
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            exit("fail");
        }

        switch ($event->type) {
            case "charge.succeeded":
                // 开发者在此处加入对支付异步通知的处理代码
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');

                $object = $event->data->object;

                $charge = Charge::retrieve($object->id);

                if($charge && $charge->paid){
                    $sn = $charge->order_no;
                    $order = Order::findOne($sn);
                    $order->pay();
                }

                break;
            case "refund.succeeded":
                // 开发者在此处加入对退款异步通知的处理代码
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');

                $object = $event->data->object;

                $charge = Charge::retrieve($object->charge);
                $refund = $charge->refunds->retrieve($object->id);
                    
                if($refund && $refund->succeed){
                }

                break;
            default:
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                break;
        }
    }
}
