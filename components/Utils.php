<?php 
namespace app\components;

class Utils 
{
    public static function isInWeixin()
    {
        if(strpos($_SERVER["HTTP_USER_AGENT"],"MicroMessenger")){
            return true;
        }else{
            return false;
        }
    }
}