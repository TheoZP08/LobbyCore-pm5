<?php

namespace NordMC\Event;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as MG;
use pocketmine\utils\Config;
use pocketmine\permission\DefaultPermissions;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityExplosionPrimeEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;

use NordMC\LobbyCore;

class Protection implements Listener {

    public function onDamage(EntityDamageEvent $ev): void {
        $pl = $ev->getEntity();
        if ($pl instanceof Player && $pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
            $ev->cancel();
        }
    }

    public function onExplosion(EntityExplosionPrimeEvent $ev): void {
        $ev->cancel();
    }

    public function onBreak(BlockBreakEvent $ev): void {
        $pl = $ev->getPlayer();
        if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
            if (!$pl->hasPermission("core.build") && !$pl->hasPermission(DefaultPermissions::ROOT_OPERATOR)) {
                $ev->cancel();
                $pl->sendPopup("§cYou don't have permissions to break blocks");
            }
        }
    }

    public function onPlace(BlockPlaceEvent $ev): void {
        $pl = $ev->getPlayer();
        if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
            if (!$pl->hasPermission("core.build") && !$pl->hasPermission(DefaultPermissions::ROOT_OPERATOR)) {
                $ev->cancel();
                $pl->sendPopup("§cYou don't have permissions to place blocks");
            }
        }
    }

    public function onDrop(PlayerDropItemEvent $ev): void {
        $pl = $ev->getPlayer();
        if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
            $ev->cancel();
        }
    }

    public function onExhaust(PlayerExhaustEvent $ev): void {
        $pl = $ev->getPlayer();
        if ($pl->getWorld() === Server::getInstance ()->getWorldManager()->getDefaultWorld()) {
            $ev->cancel();
        }
    }
}
