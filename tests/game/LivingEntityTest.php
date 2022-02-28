<?php

use Game\GameSettings;
use PHPUnit\Framework\TestCase;
use Game\Player;
use Game\WildBeast;

class LivingEntityTest extends TestCase
{

    /** @var $livingEntity */
    protected $livingEntity;

    /**
     * Set up test for livingEntity
     */
    protected function setUp()
    {
        $this->livingEntity = new Player(false);
    }

    /**
     * Test Health get/set methods
     */
    public function testGetSetHealth()
    {
        $this->livingEntity->setHealth(20);
        self::assertEquals(20, $this->livingEntity->getHealth());
    }

    /**
     * Test Strength get/set methods
     */
    public function testGetSetStrength()
    {
        $this->livingEntity->setStrength(20);
        self::assertEquals(20, $this->livingEntity->getStrength());
    }

    /**
     * Test Defence get/set methods
     */
    public function testGetSetDefence()
    {
        $this->livingEntity->setDefence(20);
        self::assertEquals(20, $this->livingEntity->getDefence());
    }

    /**
     * Test Speed get/set methods
     */
    public function testGetSetSpeed()
    {
        $this->livingEntity->setSpeed(20);
        self::assertEquals(20, $this->livingEntity->getSpeed());
    }

    /**
     * Test Luck get/set methods
     */
    public function testGetSetLuck()
    {
        $this->livingEntity->setLuck(20);
        self::assertEquals(20, $this->livingEntity->getLuck());
    }

    /**
     * Test isAlive method
     */
    public function testIsAlive()
    {
        self::assertTrue($this->livingEntity->isAlive());

        $this->livingEntity->setHealth(0);
        self::assertFalse($this->livingEntity->isAlive());
    }

    /**
     * Test takeDamage method
     */
    public function testTakeDamage()
    {

        $enemy = new WildBeast(false); //create an enemy to attack the initial entity
        $this->livingEntity->setLuck(0); //set Luck to 0 so the attack cannot be dodged

        $preAttackHealth = $this->livingEntity->getHealth();

        $damageGiven = $enemy->attack($this->livingEntity,false);

        self::assertEquals($preAttackHealth - $damageGiven, $this->livingEntity->getHealth());

        $enemy = new WildBeast(false); //create an enemy to attack the initial entity
        $this->livingEntity->setLuck(100); //set Luck to 100 so the attack is dodged

        $preAttackHealth = $this->livingEntity->getHealth();

        $damageGiven = $enemy->attack($this->livingEntity,false);

        self::assertEquals(0,$damageGiven);
        self::assertEquals($preAttackHealth, $this->livingEntity->getHealth());
    }

    /**
     * Test Skills presence
     */
    public function testSkillsPresence()
    {
        $skillCount = count(GameSettings::PLAYER_ATTRIBUTES['SKILLS']);
        self::assertEquals($skillCount, count($this->livingEntity->getSkills()));
    }

    


}
