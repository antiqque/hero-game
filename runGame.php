<?php

require 'vendor/autoload.php';

use Game\GameSettings;
use Game\LivingEntity;
use Game\Player;
use Game\GameGraphics;
use Game\WildBeast;

GameGraphics::printGraphics(GameSettings::GAME_LOGO, 0);



$player = new Player();

$enemy = new WildBeast();

for($i=1;$i<=GameSettings::TURNS;$i++){
    if($player->getSpeed() > $enemy->getSpeed()){
        $damageTaken = $player->attack($enemy);

        if($enemy->isAlive()){
            $damageTaken = $enemy->attack($player);
        }

    } elseif ($player->getSpeed() > $enemy->getSpeed()) {
        $damageTaken = $enemy->attack($player);

        if($player->isAlive()){
            $damageTaken = $player->attack($enemy);
        }
    } else {
        if($player->getLuck() > $enemy->getLuck()){
            $damageTaken = $player->attack($enemy);
    
            if($enemy->isAlive()){
                $damageTaken = $enemy->attack($player);
            }
    
        } else {
            $damageTaken = $enemy->attack($player);
    
            if($player->isAlive()){
                $damageTaken = $player->attack($enemy);
            }
        }
    }

    if(!$enemy->isAlive()){
        $enemy = new WildBeast();
    }

    if(!$player->isAlive()){
        //GAME OVER, LOSS
        GameGraphics::printGraphicsSingle("Our hero ".$player->getName()." lost the fight with ".$enemy->getName()." after fighting heroically for ".$i." rounds!");
        break;
    }
}

if($player->isAlive()){
    //GAME OVER, WIN
    GameGraphics::printGraphicsSingle("Our hero ".$player->getName()." lived to fight another day.");
}