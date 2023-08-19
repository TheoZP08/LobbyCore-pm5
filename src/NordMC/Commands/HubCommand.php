<?php

namespace NordMC\Commands;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as MG;
use pocketmine\plugin\Plugin;
use pocketmine\item\ItemFactory;
use pocketmine\item\Item;

use NordMC\LobbyCore;

class HubCommand extends Command {

    private $plugin;

    public function __construct() {
        parent::__construct("hub", "Teleport you to the server spawn!", "/hub", ["spawn", "lobby", "back"]);
    }

    public function execute(CommandSender $player, string $label, array $args): bool {
        if ($player instanceof Player) {
            $this->plugin = LobbyCore::getInstance();
            $player->teleport($player->getWorld()->getDefaultSpawnLocation());
            $player->getInventory()->clearAll();
            $player->getArmorInventory()->clearAll();
            $player->sendMessage(str_replace(["{player}"], [$player->getName()], $this->plugin->getConfig()->get("Hub-Message")));
            $player->sendTitle(str_replace(["{player}"], [$player->getName()], $this->plugin->getConfig()->get("Hub-Title")));

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
        return true;
    }
}
