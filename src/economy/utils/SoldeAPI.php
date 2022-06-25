<?php

namespace economy\utils;

use economy\Main;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class SoldeAPI {

  protected Main $plugin;

  protected int $default = 150;

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }

  public function getConfig(): Config {
    return new Config($this->plugin->getDataFolder() . "solde.yml", Config::YAML);
  }

  public function initSolde(Player $sender) {
    $config = $this->getConfig();
    if(!$config->exists($sender->getName())) {
      $config->set($sender->getName(), $this->default);
      $config->save();
    }
  }

  public function getSolde(Player $sender): bool {
    $config = $this->getConfig();
    return $config->get($sender->getName());
  }

  public function addSolde(int $amount, string $name): string {
    $config = $this->getConfig();
    if($config->exists($name)) {
      $solde = $config->get($name);
      
      $config->set($solde + $amount);
      $config->save();
      return "Ajout de §e$amount §rpour l'utitlisateur §E$name";
    } else {
      return "L'utilisateur n'existe pas sur le serveur";
    }
  }

  public function removeSolde(int $amount, string $name): string {
    $config = $this->getConfig();
    if($config->exists($name)) {
      $solde = $config->get($name);
      if(($solde - $amount) >= 0) {
        $config->set($name, $solde - $amount);
        $config->save();
      } else {
        return "L'utilisateur ne peut pas être en négatif sur le serveur.";
      }
    } else {
      return "L'utilisateur n'existe pas sur le serveur";
    }
  }

}