<?php
/*
__PocketMine Plugin__
name=MyLittleHelper
version=1.0.0
author=Impaddy
class=myLittleHelper
apiversion=10,11,12
*/

class myLittleHelper implements Plugin{
    private $api;

    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;

    }
    public function init(){
        $this->api->console->register("mlh", "My Little Helper tools!", array($this, "commands"));
        console("§a[MyLilHelper] MyLittleHelper loaded...");
        console("§a[MyLilHelper] support & suggestions twitter.com/ipaddey");
    }

    public function commands($cmd, $params, $issuer){
        $subcmd = strtolower(implode(" ", $params));
        switch($subcmd){

        }

    }

    public function __destruct(){
        //do nothing.
    }

}