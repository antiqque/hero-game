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

die();

$player = new LivingEntity();
$battleground[] = $player->setName('Orderus')
    ->setHealth(rand(70,100))
    ->setStrength(rand(70,80))
    ->setDefence(rand(45,55))
    ->setSpeed(rand(40,50))
    ->setLuck(rand(10,30))
    ->learnSkill("rapid_strike")
    ->learnSkill("magic_shield");

$enemy = new LivingEntity();
$battleground[] = $enemy->setName("Wild beast")
    ->setHealth(rand(60,90))
    ->setStrength(rand(60,90))
    ->setDefence(rand(40,60))
    ->setSpeed(rand(40,60))
    ->setLuck(rand(25,40));



$winner = '';
$fastestEntity = null;
$fastestEntityId = 0;
$fastestEntitySpeed = 0;
$fastestEntityLuck = 0;
foreach ($battleground as $entity){
    /** @var Npc $entity */

    $entitySpeed = $entity->getSpeed();
    $entityLuck = $entity->getLuck();
    if($entitySpeed >= $fastestEntitySpeed){
        if($entitySpeed == $fastestEntitySpeed && $entityLuck < $fastestEntityLuck){
            break;
        }
        $fastestEntity = $entity;
        $fastestEntityId = $entityId;
        $fastestEntitySpeed = $entitySpeed;
        $fastestEntityLuck = $entityLuck;
    }
}

echo $fastestEntity->getName(). ' charges at the enemy!'.PHP_EOL;

$numberOfTurns = 10;
for ($i = $fastestEntityId; $i < $numberOfTurns + $fastestEntityId; $i++){
    /** @var Npc $attackingNpc */
    $attackingNpc = \Game\Entity::getEntityById($battleground[$i%2]);
    /** @var Npc $defendingNpc */
    $defendingNpc = \Game\Entity::getEntityById($battleground[($i+1)%2]);

    $damageGiven = $attackingNpc->attack($defendingNpc->getId());

    echo $attackingNpc->getName() . " attacked " .$defendingNpc->getName() . PHP_EOL;
    echo $defendingNpc->getName() . " took " . $damageGiven . " damage";

    if (!$defendingNpc->isAlive()){
        echo ' '.$defendingNpc->getName() . " died!".PHP_EOL;
        $winner = $attackingNpc->getName();
        break;
    }
    echo " he has remaining " . $defendingNpc->getHealth().PHP_EOL;
}
if($winner != ''){
    echo $attackingNpc->getName() . ' won this fight!'.PHP_EOL;
}else{
    foreach ($battleground as $entityId){
        $entity = \Game\Entity::getEntityById($entityId);
        if(get_class($entity) == Npc::class){
            echo 'The ' . $entity->getName() . ' started running from our hero!'.PHP_EOL;
        }
    }
}