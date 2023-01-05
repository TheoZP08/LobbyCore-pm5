<?php

namespace NordMC\Event;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as MG;
use pocketmine\plugin\Plugin;
use pocketmine\item\ItemFactory;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use Vecnavium\FormsUI\Form;
use Vecnavium\FormsUI\FormAPI;
use Vecnavium\FormsUI\SimpleForm;
use NordMC\LobbyCore;

class EventListener extends PluginBase implements Listener {

    private $plugin;

    public function onJoin(PlayerJoinEvent $event)
    {

        $player = $event->getPlayer();
        $name = $player->getName();

        $event->setJoinMessage("");
        $this->plugin = LobbyCore::getInstance();
        Server::getInstance()->broadcastMessage(str_replace(["{player}"], [$player->getName()], $this->plugin->getConfig()->get("Join-Message")));
        $player->teleport($player->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());

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

    public function onQuit(PlayerQuitEvent $event){

        $player = $event->getPlayer();
        $name = $player->getName();

        $event->setQuitMessage("");
        Server::getInstance()->broadcastMessage(str_replace(["{player}"], [$player->getName()], $this->plugin->getConfig()->get("Quit-Message")));
    }
	
    public function onClick(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $itn = $player->getInventory()->getItemInHand()->getCustomName();
        if ($itn == "§r§bCosmetics") {
            LobbyCore::getInstance()->getUI()->getCosmetics($player);
        }
        if ($itn == "§r§cReport Player") {
            $this->getServer()->getCommandMap()->dispatch($player, "report");
        }
        if ($itn == "§r§aGames") {
            LobbyCore::getInstance()->getUI()->getGames($player);
        }
        if ($itn == "§r§dSocial Menu §7[Use]") {
            LobbyCore::getInstance()->getUI()->getSocialMenu($player);
        }
        if ($itn == "§r§5Lobby") {
            $this->getServer()->getCommandMap()->dispatch($player, "hub");
        }
    }
}
