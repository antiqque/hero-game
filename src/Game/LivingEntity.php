<?php

namespace Game;

use Game\Skills\Skill;
use Game\Skills\SkillFactory;
use Game\GameGraphics;

class LivingEntity extends Entity
{
    protected $health;
    protected $strength;
    protected $defence;
    protected $speed;
    protected $luck;

    protected $skills;

    public function isAlive(){
        return $this->getHealth() > 0 ? true:false;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth($health)
    {
        $this->health = $health>0?$health:0;
    }

    /**
     * @return int
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return int
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     */
    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return int
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param int $luck
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return isset($this->skills)?$this->skills:[];
    }

    /**
     * @param string $skillName
     * @param int $skillChance
     */
    public function learnSkill(string $skillName, array $skillProperties){
        $this->skills[] = SkillFactory::createSkill($skillName,$skillProperties);
    }

    /**
     * @param mixed $attacker
     * @param int $amount
     * @return int $damage
     */
    public function takeDamage($attacker, $amount, $verbose = true){
        $damage = abs( $amount - $this->getDefence());
        if($damage > 0){
            if($this->getLuck() < rand(1,100)){
                foreach ($this->getSkills() as $skill){
                    if($skill->getType() == Skill::DEFENSIVE){
                        $damage = $skill->castSkill($attacker,$this,['damage' => $damage]);
                    }
                }
                $this->setHealth($this->getHealth() - $damage);
                
                if($verbose){
                    GameGraphics::printGraphicsSingle($attacker->getName()." hits ".$this->getName()." for ".$damage." damage leaving them with ".$this->getHealth()." Health.");
                }
                
            } else {
                $damage = 0;

                if($verbose){
                    GameGraphics::printGraphicsSingle($this->getName()." got lucky and dodged an attack from ".$attacker->getName().". His current health is ".$this->getHealth());
                }
            }
            
        }

        return $damage;
    }

    /**
     * @param mixed $targetEntity
     * @return int
     */
    public function attack($targetEntity, $verbose = true){
        $damage = $this->getStrength();
        foreach ($this->getSkills() as $skill){
            if($skill->getType() == Skill::OFFENSIVE){
                $damage = $skill->castSkill($this,$targetEntity,['damage' => $damage]);
            }
        }
        return $targetEntity->takeDamage($this,$damage,$verbose);
    }
}