<?php

namespace BNTFeujjj\fNoFallDamage;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase implements Listener {

    use SingletonTrait;
    public function onLoad(): void
    {
        self::setInstance($this);
    }
    public function onEnable(): void
    {
        $this->saveDefaultConfig();
       $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onFallDamage(EntityDamageEvent $event): void {
        $entity = $event->getEntity();
        $config = $this->getConfig();
        if ($entity instanceof Player) {
            if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
                if (in_array($entity->getWorld()->getFolderName(), $config->get("worlds", []))) {
                    $event->cancel();
                }
            }
        }
    }
}