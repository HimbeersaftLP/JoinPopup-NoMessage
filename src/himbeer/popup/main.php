<?php
namespace himbeer\popup;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\config;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerDeathEvent;
class Main extends PluginBase implements Listener{
     
     public function onEnable(){
          $this->getServer()->getPluginManager()->registerEvents($this,$this);
          $this->getLogger()->info("SteakIt enabled!");
          @mkdir($this->getDataFolder());
          $this->config = new Config ($this->getDataFolder() . "config.yml" , Config::YAML, array(
               "join" => "§a-player- joined the game!",
               "quit" => "§4-player- left the game!",
          ));
          $this->saveResource("config.yml");
     }
}
