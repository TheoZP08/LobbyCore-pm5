<?php

declare(strict_types=1);

namespace NordMC\Task;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\world\WorldManager;
use pocketmine\world\Time;

class AlwaysDay extends Task
{
    public function onRun(): void {
        $worldManager = Server::getInstance()->getWorldManager();
        
        foreach ($worldManager->getWorlds() as $world) {
            if ($world instanceof WorldManager) {
                $world->setTime(Time::TIME_DAY);
            }
        }
    }
}

