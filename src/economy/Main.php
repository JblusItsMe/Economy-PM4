<?php

namespace economy;

use economy\utils\SoldeAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

  protected function onEnable(): void {
    $this->getLogger()->notice("§aActivé");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  protected function onDisable(): void {
    $this->getLogger()->notice("§aActivé");
  }

  public function onJoin(PlayerJoinEvent $event) {
    $sender = $event->getPlayer();

    (new SoldeAPI($this))->initSolde($sender);
  }

}