<?php

namespace JerbyYT\sw;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{
	
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveResource("config.yml");
    }
	
    public function onChat(PlayerCommandPreprocessEvent $event){
        $player = $event->getPlayer();
        $msg = strtolower($event->getMessage());

		if(!$player->isOp()){
			foreach($this->getConfig()->get("words") as $words){
				if(strpos($msg, $words) !== false) {
					var_dump($words);
					$event->setCancelled(true);
					$player->sendMessage($this->getConfig()->get("message"));
				}
			}
		}
	}
}