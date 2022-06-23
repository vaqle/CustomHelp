<?php
namespace vale\help;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\Server;
use pocketmine\command\CommandSender;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase
{
	use SingletonTrait;

	public function onLoad(): void
	{
		$this->saveResource("config.yml");
		self::setInstance($this);
	}

	public function onEnable(): void
	{
		$map = Server::getInstance()->getCommandMap();
		$map->unregister($map->getCommand("help"));
		$command = new class("Help") extends Command{
			public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
				$sender->sendMessage(join("\n", Main::getInstance()->getConfig()->get("help") ?? []));
				return true;
			}
		};
		$help = $command;
		$help->setAliases(["help"]);
		$map->register("xd", $help); //s.o to muq for the hack
	}
}
