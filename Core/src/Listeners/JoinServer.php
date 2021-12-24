<?php

declare(strict_types=1);

namespace Besher\Core\Listeners;

use Besher\Core\Main;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\ItemFactory;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as T;

class JoinServer implements \pocketmine\event\Listener{


	public function __construct(Main $pg){
		$this->plugin = $pg;
	}

	public function JoinServer(PlayerJoinEvent $event)
	{
		$event->getPlayer()->getNetworkSession()->syncGameMode($event->getPlayer()->getGamemode());
		$database = Main::getDatabase();
		$database->FirstJoin($event->getPlayer());

		$navigator = ItemFactory::getInstance()->get(345)->setCustomName(T::RESET.T::GREEN."Teleporter");
		$cosmetics = ItemFactory::getInstance()->get(264)->setCustomName(T::RESET.T::GREEN."Cosmetics");
		$settings = ItemFactory::getInstance()->get(397)->setCustomName(T::RESET.T::YELLOW."Profile Settings");
		$friends = ItemFactory::getInstance()->get(421)->setCustomName(T::RESET.T::DARK_PURPLE."Social Menu");

		$event->getPlayer()->getInventory()->clearAll();
		$event->getPlayer()->getEffects()->clear();
		$event->getPlayer()->getInventory()->setItem(0, $navigator);
		$event->getPlayer()->getInventory()->setItem(6, $cosmetics);
		$event->getPlayer()->getInventory()->setItem(7, $friends);
		$event->getPlayer()->getInventory()->setItem(8, $settings);



	}
}