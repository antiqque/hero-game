<?php

namespace Game;

use Game\GameSettings;
use Game\GameGraphics;

class WildBeast extends LivingEntity
{
    protected $type;

    public function __construct($verbose = true)
    {
        $this->setType($this->getRandomBeastType());
        $this->setName(ucfirst(strtolower($this->getType())));
        $this->setHealth(rand(GameSettings::WILD_BEAST_ATTRIBUTES['HP_MIN_VAL'],GameSettings::WILD_BEAST_ATTRIBUTES['HP_MAX_VAL']));
        $this->setStrength(rand(GameSettings::WILD_BEAST_ATTRIBUTES['STR_MIN_VAL'],GameSettings::WILD_BEAST_ATTRIBUTES['STR_MAX_VAL']));
        $this->setDefence(rand(GameSettings::WILD_BEAST_ATTRIBUTES['DEF_MIN_VAL'],GameSettings::WILD_BEAST_ATTRIBUTES['DEF_MAX_VAL']));
        $this->setSpeed(rand(GameSettings::WILD_BEAST_ATTRIBUTES['SPD_MIN_VAL'],GameSettings::WILD_BEAST_ATTRIBUTES['SPD_MAX_VAL']));
        $this->setLuck(rand(GameSettings::WILD_BEAST_ATTRIBUTES['LUCK_MIN_VAL'],GameSettings::WILD_BEAST_ATTRIBUTES['LUCK_MAX_VAL']));

        if(isset(GameSettings::WILD_BEAST_ATTRIBUTES['SKILLS']) && count(GameSettings::WILD_BEAST_ATTRIBUTES['SKILLS']) > 0){
            foreach(GameSettings::WILD_BEAST_ATTRIBUTES['SKILLS'] as $skill_name=>$skill_chance){
                $this->learnSkill($skill_name,$skill_chance);
            }
        }

        if($verbose){
            GameGraphics::printGraphicsSingle("As our hero ".GameSettings::PLAYER_NAME." walks the ever-green forests of Emagia, he encounters a ".$this->getName()."!");

            GameGraphics::printGraphics(GameSettings::ENEMY_GRAPHICS[$this->getType()]);
        }

    }

    public function getRandomBeastType(){
        return GameSettings::WILD_BEAST_TYPES[rand(0,count(GameSettings::WILD_BEAST_TYPES)-1)];
    }

    public function setType($type){
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(){
        return $this->type;
    }
}