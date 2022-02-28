<?php

namespace Game\Skills;

use Game\Entity;
use Game\GameGraphics;

class SkillMagicShield extends Skill implements SkillInterface {

    public function __construct($properties)
    {
        $this->setName('Magic shield');
        $this->setDescription('Takes only half of the usual damage when an enemy attacks, there\'s a '.$this->getSkillChance().'% change he\'ll use this skill every time he defends.');
        $this->setChance($properties['CHANCE']);
        $this->setType($properties['TYPE']);

        return $this;
    }

    public function castSkill($caster, Entity $entity, array $params = [], $verbose = true)
    {
        $damage = $params['damage'];
        if($damage > 0){
            if($this->getChance() >= rand(1, 100)){
                $damage = intval ( $damage / 2 );

                if($verbose){
                    GameGraphics::printGraphicsSingle($entity->getName()." uses ".$this->getName()." on himself");
                }
            }
        }
        return $damage;
    }

    public function getSkillChance()
    {
        parent::getChance();
    }
}