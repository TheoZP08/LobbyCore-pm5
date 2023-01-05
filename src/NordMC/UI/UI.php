<?php

namespace NordMC\UI;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as MG;

use Vecnavium\FormsUI\Form;
use Vecnavium\FormsUI\FormAPI;
use Vecnavium\FormsUI\SimpleForm;

use NordMC\LobbyCore;

class UI {

    public $plugin;

    public function __construct(){
        $this->plugin = LobbyCore::getInstance();
    }

    public function getCosmetics(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    if ($player->hasPermission("core.use.fly")){
                        $this->FlyForm($player);
                    } else {
                        $player->sendMessage($this->plugin->getConfig()->get("§cYou not have permissions to use cosmetics Fly"));
                    }
                break;

                case 1:
                    if ($player->hasPermission("core.use.size")){
                        $this->SizeForm($player);
                    } else {
                        $player->sendMessage($this->plugin->getConfig()->get("§cYou not have permissions to use cosmetics Size"));
                    }
                break;

                case 2:
                    $this->getServer()->getCommandMap()->dispatch($player, "nick");
                break;

                case 3:
                    if ($player->hasPermission("core.use.namecolor")){
                        $this->NameColorForm($player);
                    } else {
                        $player->sendMessage($this->plugin->getConfig()->get("§cYou not have permissions to use cosmetics NameColor"));
                    }
                break;

                case 4:
                    $this->getServer()->getCommandMap()->dispatch($player, "cape");
                break;

                case 5:
                   
                break;
            }
        });
        $form->setTitle(MG::YELLOW . $this->plugin->getConfig()->get("CosmeticTitle"));
        $form->setContent(MG::RED . $this->plugin->getConfig()->get("CosmeticInfo"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("CosmeticForm1"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("CosmeticForm2"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("CosmeticForm3"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("CosmeticForm4"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("CosmeticForm5"));
        $form->addButton(MG::RED . "EXIT");
        $form->sendToPlayer($player);
    }
    
    public function FlyForm(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $player->setFlying(true);
                    $player->setAllowFlight(true);
                    $player->sendMessage("§aFLY §aON");
                    $player->sendTitle("§aFLY §aON");
                    break;
                case 1:
                    $player->setFlying(false);
                    $player->setAllowFlight(false);
                    $player->sendMessage("FLY OFF");
                    $player->sendTitle("FLY OFF");
                    break;
            }
        });
        $form->setTitle(MG::BLUE . $this->plugin->getConfig()->get("FlyTitle"));
        $form->setContent(MG::GRAY . $this->plugin->getConfig()->get("FlyInfo"));
        $form->addButton(MG::GREEN . $this->plugin->getConfig()->get("FlyForm1"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("FlyForm2"));
        $form->addButton(MG::RED . "EXIT");
        $form->sendToPlayer($player);
    }

    public function SizeForm(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $player->setScale("0.5");
                    $player->sendMessage(MG::GREEN . $this->plugin->getConfig()->get("SizeMessageSmall"));
                    break;
                case 1:
                    $player->setScale("1.0");
                    $player->sendMessage(MG::GREEN . $this->plugin->getConfig()->get("SizeMessageNormal"));
                    break;
                case 2:
                    $player->setScale("1.5");
                    $player->sendMessage(MG::GREEN . $this->plugin->getConfig()->get("SizeMessageBig"));
                    break;
            }
        });
        $form->setTitle(MG::BLUE . $this->plugin->getConfig()->get("SizeTitle"));
        $form->setContent(MG::GRAY . $this->plugin->getConfig()->get("SizeInfo"));
        $form->addButton(MG::GREEN . $this->plugin->getConfig()->get("SizeForm1"));
        $form->addButton(MG::GREEN . $this->plugin->getConfig()->get("SizeForm2"));
        $form->addButton(MG::GREEN . $this->plugin->getConfig()->get("SizeForm3"));
        $form->addButton(MG::RED . "EXIT");
        $form->sendToPlayer($player);
    }
    public function NameColorForm(Player $player){
        $form = new SimpleForm(function (Player $player, $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $player->setDisplayName("§f" . $player->getName() . "§f");
                    $player->setNameTag("§f" . $player->getName() . "§f");
                    $player->sendMessage("§aYour nickname color has been changed to §fWhite!");
                break;
                case 1:
                    $player->setDisplayName("§c" . $player->getName() . "§f");
                    $player->setNameTag("§c" . $player->getName() . "§f");
                    $player->sendMessage("§aYour nickname color has been changed to §cRed!");
                break;
                case 2:
                    $player->setDisplayName("§b" . $player->getName() . "§f");
                    $player->setNameTag("§b" . $player->getName() . "§f");
                    $player->sendMessage("§aYour nickname color has been changed to §bBlue!");
                break;
                case 3:
                    $player->setDisplayName("§e" . $player->getName() . "§f");
                    $player->setNameTag("§e" . $player->getName() . "§f");
                    $player->sendMessage("§aYour nickname color has been changed to §eYellow!");
                break;
                case 4:
                    $player->setDisplayName("§6" . $player->getName() . "§f");
                    $player->setNameTag("§6" . $player->getName() . "§f");
                    $player->sendMessage("§aYour nickname color has been changed to §6Orange!");
                break;
                case 5:
                    $player->setDisplayName("§d" . $player->getName() . "§f");
                    $player->setNameTag("§d" . $player->getName() . "§f");
                    $player->sendMessage("§aYour nickname color has been changed to §dPurple!");
                break;
                case 6:
                    $player->setDisplayName("§0" . $player->getName() . "§f");
                    $player->setNameTag("§0" . $player->getName() . "§f");
                    $player->sendMessage("§aYour nickname color has been changed to §0Black!");
                break;
                case 0:

                break;
            }
            return true;
        });
        $form->setTitle("§bNameColors");
        $form->setContent("§fSelect your color you prefer to your name!");
        $form->addButton("§fWhite");
		$form->addButton("§cRed");
		$form->addButton("§bBlue");
		$form->addButton("§eYellow");
		$form->addButton("§6Orange");
		$form->addButton("§dPurple");
        $form->addButton("§0Black");
        $form->addButton("§0Black");
        $form->addButton(MG::RED . "EXIT");
        $form->sendToPlayer($player);
    }
    
    public function getGames(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, $this->plugin->getConfig()->get("CommandForm1"));
                    break;
                case 1:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, $this->plugin->getConfig()->get("CommandForm2"));
                    break;
                case 2:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, $this->plugin->getConfig()->get("CommandForm3"));
                    break;
                case 3:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, $this->plugin->getConfig()->get("CommandForm4"));
                    break;
                case 4:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, $this->plugin->getConfig()->get("CommandForm5"));
                    break;
                case 5:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, $this->plugin->getConfig()->get("CommandForm6"));
                    break;
            }
        });
        $form->setTitle(MG::RED . $this->plugin->getConfig()->get("GameTitle"));
        $form->setContent(MG::RED . $this->plugin->getConfig()->get("GameInfo"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("GameForm1"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("GameForm2"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("GameForm3"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("GameForm4"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("GameForm5"));
        $form->addButton(MG::RED . $this->plugin->getConfig()->get("GameForm6"));
        $form->addButton(MG::RED . "EXIT");
        $form->sendToPlayer($player);
    }

    public function getSocialMenu(Player $player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($player, "party");
                    $player->sendMessage("§cSoon...");
                break;
                case 1:
                    $this->getServer()->getCommandMap()->dispatch($player, "friend");
                    $player->sendMessage("§cSoon...");
                break;

                case 2:
                    
                break;
            }
        });
        $form->setTitle("§bSocial Menu");
        $form->setContent("§cSoon..");
        $form->addButton("§eParty");
        $form->addButton("§eFriends");
        $form->addButton(MG::RED . "EXIT");
        $form->sendToPlayer($player);
    }
}