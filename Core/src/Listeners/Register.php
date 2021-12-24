<?php

declare(strict_types=1);

namespace Besher\Core\Listeners;

use Besher\Core\Main;


class Register{

	public static function init(): void {
		$instance = Main::getInstance();
		$server = $instance->getServer();
		$reg = $server->getPluginManager();

		$reg->registerEvents(new ItemClicks($instance), $instance);
		$reg->registerEvents(new JoinServer($instance), $instance);
	}

}