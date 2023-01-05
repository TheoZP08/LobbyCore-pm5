<?php

namespace NordMC\Commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender; 
use pocketmine\utils\TextFormat as MG;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
use pocketmine\Server;
use pocketmine\plugin\Plugin;
use pocketmine\item\ItemFactory;
use pocketmine\item\Item;

class ItemCommand extends Command {
  
  public function __construct(){
    parent::__construct("item", "back item command", null, []);
  }
  
  public function execute(CommandSender $player, string $label, array $args){
    if($player instanceof Player){
       $player->getInventory()->clearALL();
       $player->getArmorInventory()->clearALL();

      $item1 = ItemFactory::getInstance()->get(345, 0, 1)->setCustomName("§r§bCosmetics");
      $item2 = ItemFactory::getInstance()->get(54, 0, 1)->setCustomName("§r§cReport Player");
      $item3 = ItemFactory::getInstance()->get(340, 0, 1)->setCustomName("§r§aGames");
      $item4 = ItemFactory::getInstance()->get(345, 0, 1)->setCustomName("§r§dSocial Menu §7[Use]");
      $item5 = ItemFactory::getInstance()->get(54, 0, 1)->setCustomName("§r§5Lobby");
 
      $player->getInventory()->clearAll();
      $player->getInventory()->setItem(0, $item1);
      $player->getInventory()->setItem(1, $item2);
      $player->getInventory()->setItem(4, $item3);
      $player->getInventory()->setItem(7, $item4);
      $player->getInventory()->setItem(8, $item5);
    }
  }
}