<?php

namespace Besher\Core\Listeners;

use Besher\Core\Main;

use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as T;
use Besher\Core\libs\jojoe77777\FormAPI\SimpleForm;

class ItemClicks implements \pocketmine\event\Listener{

	public function __construct(Main $pg){
		$this->plugin = $pg;
	}

	public function OnClick(PlayerInteractEvent $e)
	{
		if($e->getItem()->getId() == 345 AND $e->getItem()->getCustomName() == T::RESET.T::LIGHT_PURPLE."Navigator"){
			$this->playSound("random.pop", $e->getPlayer());
			$this->Navigation($e->getPlayer());
			$e->cancel();
		}

		if($e->getItem()->getId() == 264 AND $e->getItem()->getCustomName() == T::RESET.T::GREEN."Cosmetics"){
			$this->playSound("random.pop", $e->getPlayer());
			$this->Cosmetics($e->getPlayer());
			$e->cancel();
		}

		if($e->getItem()->getId() == 397 AND $e->getItem()->getCustomName() == T::RESET.T::YELLOW."Profile & Settings"){
			$this->playSound("random.pop", $e->getPlayer());
			$this->Settings($e->getPlayer());
			$e->cancel();
		}

		if($e->getItem()->getId() == 421 AND $e->getItem()->getCustomName() == T::RESET.T::WHITE."Friends"){
			$this->playSound("random.pop", $e->getPlayer());
			$this->Friends($e->getPlayer());
			$e->cancel();
		}

	}

	public function ItemDrop(PlayerDropItemEvent $e){
		if($e->getItem()->getId() == 345 AND $e->getItem()->getCustomName() == T::RESET.T::GREEN."Teleporter"){
			$e->cancel();
		}

		if($e->getItem()->getId() == 264 AND $e->getItem()->getCustomName() == T::RESET.T::GREEN."Cosmetics"){
			$e->cancel();
		}

		if($e->getItem()->getId() == 397 AND $e->getItem()->getCustomName() == T::RESET.T::YELLOW."Profile Settings"){
			$e->cancel();
		}

		if($e->getItem()->getId() == 421 AND $e->getItem()->getCustomName() == T::RESET.T::DARK_PURPLE."Social Menu"){
			$e->cancel();
		}
	}

	public function playSound(string $soundName, Player $player): void {
		$sound = new PlaySoundPacket();
		$sound->x = $player->getPosition()->getX();
		$sound->y = $player->getPosition()->getY();
		$sound->z = $player->getPosition()->getZ();
		$sound->volume = 1;
		$sound->pitch = 1;
		$sound->soundName = $soundName;
		$player->getNetworkSession()->sendDataPacket($sound);
	}

	public function Navigation(Player $player)
	{
		$form = new SimpleForm(function(Player $player, $data) {
			switch($data){

			}
		});
		$form->setTitle(T::RED."Navigator");
		$form->addButton("Lobby");
		$player->sendForm($form);
		return $form;
	}

	public function Cosmetics(Player $player)
	{
		$form = new SimpleForm(function(Player $player, $data) {
			switch($data){
				case 0:
					break;
				case 1:
					break;
				case 2:
					break;
				case 3:
					break;
			}
		});
		$form->setTitle(T::DARK_PURPLE."Cosmetics");
		$form->addButton(T::YELLOW."Particles");
		$form->addButton(T::WHITE."Effects");
		$form->addButton("Armor");
		$form->addButton("Capes");
		$player->sendForm($form);
		return $form;
	}

	public function Social(Player $player)
	{
		$form = new SimpleForm(function(Player $player, $data) {
			switch($data){
				case 0:
					break;
				case 1:
					break;
				case 2:
					break;

			}
		});
		$form->setTitle(T::WHITE."Social Menu");
		$form->addButton(T::AQUA."Friends");
		$form->addButton(T::YELLOW."Parties");
		$form->addButton("Nametag");
		$player->sendForm($form);
		return $form;
	}

	public function Settings(Player $player)
	{
		$form = new SimpleForm(function(Player $player, $data) {
			switch($data){
				case 0:
					break;
				case 1:
					break;
				case 2:
					break;
			}
		});
		$form->setTitle(T::AQUA."Profile & Settings");
		$form->addButton("Preferences");
		$form->addButton("Chat Settings");
		$form->addButton("Language");
		$player->sendForm($form);
		return $form;
	}

}