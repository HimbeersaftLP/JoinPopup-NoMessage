<?php

namespace himbeer\popup;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;

class main extends PluginBase implements Listener {

     public function onEnable(): void {
          $this->getServer()->getPluginManager()->registerEvents($this, $this);
          $this->saveDefaultConfig();
     }

     /**
      * @param $event PlayerJoinEvent|PlayerQuitEvent
      * @param $type string Either "join" or "quit"
      */
     private function handleJoinQuit($event, string $type): void {
          $message = str_replace(
               "{player}",
               $event->getPlayer()->getName(),
               $this->getConfig()->get($type)
          );
          if ($this->getConfig()->get("mode") === "popup") {
               $this->getServer()->broadcastPopup($message);
          } else {
               $this->getServer()->broadcastTip($message);
          }
     }

     public function onJoin(PlayerJoinEvent $event): void {
          if ($this->getConfig()->get("stop_messages"))
               $event->setJoinMessage("");
          $this->handleJoinQuit($event, "join");
     }

     public function onQuit(PlayerQuitEvent $event): void {
          if ($this->getConfig()->get("stop_messages"))
               $event->setQuitMessage("");
          $this->handleJoinQuit($event, "quit");
     }
}
