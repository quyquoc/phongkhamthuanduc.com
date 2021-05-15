<?php

namespace Modules\Library\Oh;

class TelegramBot
{
    private $token = "1613541684:AAHQOK3A7TbilPCYnh8xETBPN0IhFkSbprc";
    private $api = "https://api.telegram.org/bot";
    function __construct()
    {
        $this->api .= $this->token;
    }

    public function sendBaseMessageCSKH($dataText, $htmlMode = true){
        $chat_id = "-494373638";
        return $this->sendBasicMessage($chat_id, $dataText, $htmlMode);
    }

    public  function sendBasicMessage($chat_id, $dataText, $htmlMode = true){
        $api = $this->api ."/sendMessage";
        $teleData = array(
            "chat_id" => $chat_id,
            "text" => $dataText
        );

        if($htmlMode){
            $teleData["parse_mode"] = "html";
        }
        $provider  = \Phalcon\Http\Client\Request::getProvider();
        $provider->setBaseUri($api);
        $provider->header->set('Accept', 'application/json');
        $provider->post("", $teleData);
        return true;
    }

    private static $_obj;
    public static function create(){
        if(self::$_obj===null){
            self::$_obj = new TelegramBot();
        }
        return self::$_obj;
    }
}