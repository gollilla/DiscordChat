<?php 

namespace soradore\DiscordChat;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;




class main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        //$this->start();
    }

    public function start(){
        $task = new ReceiveTask();
        $this->getServer()->getAsyncPool()->submitTask($task);
    }


    public function onJoin(PlayerJoinEvent $ev){
        $this->start();
    }
}