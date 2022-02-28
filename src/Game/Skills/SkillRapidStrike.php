<?php

namespace Game\Skills;

use Game\Entity;
use Game\GameGraphics;

class SkillRapidStrike extends Skill implements SkillInterface {

    public function __construct($properties)
    {
        $this->setName('Rapid Strike');
        $this->setDescription('Strike twice while it\'s his turn to attack, there\'s a '.$this->getSkillChance().'% he\'ll use this skill every time he attacks.');
        $this->setChance($properties['CHANCE']);
        $this->setType($properties['TYPE']);
    }

    public function castSkill($caster, Entity $entity, array $params = [], $verbose = true)
    {
        $damage = isset($params['damage'])?$params['damage']:0;
        if($damage > 0 && $this->getChance() >= rand(1, 100)){
            $damage = $damage * 2;

            if($verbose){
                GameGraphics::printGraphicsSingle($caster->getName()." uses ".$this->getName()." on ".$entity->getName());
            }
        }
        return $damage;
    }

    /**
     * @return int
     */
    public function getSkillChance()
    {
        parent::getChance();
    }
}