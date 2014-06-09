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
    private $maintance = false;

    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;


    }
    public function init(){
        $this->api->addHandler("player.connect", array($this, "eventHandler"), 100);
        $this->api->console->register("mlh", "My Little Helper tools!", array($this, "commands"));
        $this->api->console->register("broadcast", "My Little Helper tools!", array($this, "standaloneCommands"));
        console("§a[MyLilHelper] MyLittleHelper loaded...");
        console("§a[MyLilHelper] support & suggestions twitter.com/ipaddey");
        $this->api->addHandler("player.connect", array($this, "eventHandler"), 100);
    }
    //listen to events for maintenance mode etc
    public function eventHandler($data, $event)
    {
        switch($event)
        {
            case 'player.connect':

                if($this->maintance == true)
                {
                    return false;
                }

                break;

        }
    }

    public function commands($cmd, $params, $issuer){
        $subcmd = strtolower(implode(" ", $params));
        switch($subcmd){

            case "save":
                $this->api->autoSave();
                console("[MyLilhelper] Saving world initated by $issuer");
                $issuer->sendChat("<MyLilHelper> Saving World...");
                break;

            case "gps":
                $player = $issuer;
                $x_cord = $player->entity->x;
                $y_cord = $player->entity->y;
                $z_cord = $player->entity->z;
                $world = $player->entity->level->getName();
                $issuer->sendChat("<MyLilHelper> GPS: $x_cord, $y_cord, $z_cord, World: $world");
                break;
            case "maintenance on":
                $this->maintance = true;
                $this->api->chat->broadcast("[MyLilHelper] Maintenance mode enabled!");
                console("[MyLittleHelper] Maintenance mode enabled, no incoming connections will be accepted.");
                break;
            case "maintenance off":
                $this->maintance = false;
                $this->api->chat->broadcast("[MyLilHelper] Maintenance mode disabled!");
                console("[MyLittleHelper] Maintenance mode disabled, connections allowed.");
                break;
        }

    }
    public function standaloneCommands($cmd, $params, $issuer){
        $this->api->chat->broadcast($params);

    }

    public function __destruct(){
        //do nothing.
    }

}