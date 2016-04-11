<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;

use Pingpp\Pingpp;
use Pingpp\Event;
use Pingpp\Charge;
use Pingpp\RedEnvelope;

use app\models\Extract;
use app\models\Order;

class PingxxController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * pingxx webhook
     */
    public function actionWebhook()
    {
        Pingpp::setApiKey($_ENV['PINGXX_APIKEY']);

        $event = json_decode(file_get_contents("php://input"));

        // 对异步通知做处理
        if (!isset($event->type)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            exit("fail");
        }

        $event = Event::retrieve($event->id);
        $object = $event->data->object;

        if(!$event){
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            exit("fail");
        }

        switch ($event->type) {
            case "charge.succeeded":
                // 开发者在此处加入对支付异步通知的处理代码
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');

                $charge = Charge::retrieve($object->id);

                if($charge && $charge->paid){
                    $sn = $charge->order_no;
                    $order = Order::findOne(['sn' => $sn]);
                    $order->pay();
                }

                break;
            case "refund.succeeded":
                // 开发者在此处加入对退款异步通知的处理代码
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');

                $charge = Charge::retrieve($object->charge);
                $refund = $charge->refunds->retrieve($object->id);
                    
                if($refund && $refund->succeed){
                }

                break;
            case "red_envelope.sent":
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');

                $redEnvelop = RedEnvelope::retrieve($object->id);

                break;
            case "red_envelope.received":
                $redEnvelop = RedEnvelope::retrieve($object->id);
                if($redEnvelop){
                    $extract = Extract::findOne($redEnvelop->order_no);
                    $extract->transactionNo = $redEnvelop->transaction_no;
                    $extract->finish();
                }
                break;
            default:
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                break;
        }
    }
}
