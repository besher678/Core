<?php

declare(strict_types=1);

namespace Besher\Core\Managers;

use Besher\Core\Main;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Database{

	public function __construct(Main $pg){
		$this->plugin = $pg;
		$this->player = new \SQLite3($this->plugin->getDataFolder() . "db/"  . "Players.db");
		$this->player->query("CREATE TABLE IF NOT EXISTS player(uuid TEXT PRIMARY KEY, player TEXT, kills INT, deaths INT, device TEXT, friends TEXT);");
	}

	public function FirstJoin(Player\Player $player){
		$uuid = $player->getUniqueId();
		$name = $player->getName();
		$this->player->exec("INSERT OR REPLACE INTO player(uuid, player, kills, deaths)VALUES('$uuid', '$name', 0, 0);");

	}

	public function PlayerExists(String $name) : bool{
		$array = $this->player->query("SELECT * FROM player WHERE player = '$name'");
		$result = $array->fetchArray(SQLITE3_ASSOC);
		if($result == null){
			return false;
		}
		return true;
	}


}