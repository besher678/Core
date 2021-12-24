<?php

declare(strict_types=1);

namespace Besher\Core;

use Besher\Core\Commands\RegisterCommands;
use Besher\Core\Listeners\Register;
use pocketmine\plugin\PluginBase;
use Besher\Core\Managers\Database;

class Main extends PluginBase{

	private static $instance;
	private static $database;


	public function onEnable() : void{
		@mkdir($this->getDataFolder() . "db/");
		self::$instance = $this;
		self::$database = new Database($this);

		Register::init();
		RegisterCommands::init();
	}

	public static function getInstance(): Main
	{
		return self::$instance;
	}

	public static function getDatabase(): Database
	{
		return self::$database;
	}




}
