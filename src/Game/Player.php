<?php

namespace Game;

use Game\GameSettings;

class Player extends LivingEntity
{
    public function __construct($verbose = true)
    {
        $this->setName(GameSettings::PLAYER_NAME);
        $this->setHealth(rand(GameSettings::PLAYER_ATTRIBUTES['HP_MIN_VAL'],GameSettings::PLAYER_ATTRIBUTES['HP_MAX_VAL']));
        $this->setStrength(rand(GameSettings::PLAYER_ATTRIBUTES['STR_MIN_VAL'],GameSettings::PLAYER_ATTRIBUTES['STR_MAX_VAL']));
        $this->setDefence(rand(GameSettings::PLAYER_ATTRIBUTES['DEF_MIN_VAL'],GameSettings::PLAYER_ATTRIBUTES['DEF_MAX_VAL']));
        $this->setSpeed(rand(GameSettings::PLAYER_ATTRIBUTES['SPD_MIN_VAL'],GameSettings::PLAYER_ATTRIBUTES['SPD_MAX_VAL']));
        $this->setLuck(rand(GameSettings::PLAYER_ATTRIBUTES['LUCK_MIN_VAL'],GameSettings::PLAYER_ATTRIBUTES['LUCK_MAX_VAL']));

        if(isset(GameSettings::PLAYER_ATTRIBUTES['SKILLS']) && count(GameSettings::PLAYER_ATTRIBUTES['SKILLS']) > 0){
            foreach(GameSettings::PLAYER_ATTRIBUTES['SKILLS'] as $skillName=>$skillProperties){
                $this->learnSkill($skillName,$skillProperties);
            }
        }

        if($verbose){
            GameGraphics::printGraphics([
                "After battling all kinds of monsters for more than a hundred years, ".GameSettings::PLAYER_NAME." now has the following stats:",
                "Health:   ".$this->getHealth(),
                "Strength: ".$this->getStrength(),
                "Defence:  ".$this->getDefence(),
                "Speed:    ".$this->getSpeed(),
                "Luck:     ".$this->getLuck()
            ]);
    
            GameGraphics::printGraphicsSingle("Also, he possesses ".count($this->getSkills())." skills:");
    
            foreach($this->getSkills() as $skill){
                GameGraphics::printGraphics([
                    $skill->getName().": ".$skill->getDescription()
                ]);
            }
        }

    }
}