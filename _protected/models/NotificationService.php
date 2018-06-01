<?php

namespace app\models;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class NotificationService{

    private $server;

    const DEFAULT_SERVER = "localhost";
    const DEFAULT_PORT = "3000";
    
    public static function emit($emitName,$data,$server = self::DEFAULT_SERVER ,$port = self::DEFAULT_PORT){
        $client = new Client(new Version2X($server.':'.$port));
        $client->initialize();
        $client->emit($emitName, $data);
        $client->close();        


    }
}