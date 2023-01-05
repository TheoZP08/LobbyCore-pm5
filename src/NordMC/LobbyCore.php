<?php

namespace NordMC;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as MG;

//Events

use NordMC\Event\EventListener;
use NordMC\Event\Protection;

//Commands

use NordMC\Commands\HubCommand;
use NordMC\Commands\ItemCommand;

//Uis

use NordMC\UI\UI;

class LobbyCore extends PluginBase implements Listener {

    private static $instance;
	
	public function onLoad() : void {
		self::$instance = $this;
	}

    public function onEnable(): void {
        $this->getLogger()->info(MG::GREEN . "LobbyCore Enabled");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Protection(), $this);
        $this->getServer()->getCommandMap()->register("/hub", new HubCommand());
        $this->getServer()->getCommandMap()->register("/item", new ItemCommand());
        $this->saveResource("config.yml");
    }

    public function onDisable(): void {

    }

    public static function getInstance() : LobbyCore {
        return self::$instance;
    }
    public static function getUI() : UI {
        return new UI();
    }
}
