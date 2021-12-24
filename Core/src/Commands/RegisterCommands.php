<?php

declare(strict_types=1);

namespace Besher\Core\Commands;

use Besher\Core\Main;

class RegisterCommands{

	public static function init(): void {
		$instance = Main::getInstance();
		$server = $instance->getServer();
		$map = $server->getCommandMap();
	}

}