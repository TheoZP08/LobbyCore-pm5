<?php

namespace NordMC\Event;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as MG;
use pocketmine\utils\Config;
use pocketmine\permission\DefaultPermissions;

use NordMC\LobbyCore;

class Protection implements \pocketmine\event\Listener {

	public function onDamage(\pocketmine\event\entity\EntityDamageEvent $ev) {
		$pl = $ev->getEntity();
		if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
			    $ev->cancel();
		}
	}
	
	public function onExplosion(\pocketmine\event\entity\ExplosionPrimeEvent $ev) {
		$ev->cancel();
		
	}
	
	public function onBreak(\pocketmine\event\block\BlockBreakEvent $ev) {
		$pl = $ev->getPlayer();
		if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
            if (!$pl->hasPermission("core.build") && !$pl->hasPermission(DefaultPermissions::ROOT_OPERATOR)) {
				$ev->cancel();
                $pl->sendPopup("§cYou have don't permissions for break blocks");
			} else {
            }
		}
	}
	
	public function onPlace(\pocketmine\event\block\BlockPlaceEvent $ev) {
		$pl = $ev->getPlayer();
		if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
            if (!$pl->hasPermission("core.build") && !$pl->hasPermission(DefaultPermissions::ROOT_OPERATOR)) {
				$ev->cancel();
                $pl->sendPopup("§cYou have don't permissions for place blocks");
			} else {
			}
		}
	}
	
	public function onDrop(\pocketmine\event\player\PlayerDropItemEvent $ev) {
		$pl = $ev->getPlayer();
		if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
			$ev->cancel();
		}
	}

	public function onExhaust(\pocketmine\event\player\PlayerExhaustEvent $ev) {
		$pl = $ev->getPlayer();
		if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
			$ev->cancel();
		}
	}
}