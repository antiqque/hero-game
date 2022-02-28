<?php

use PHPUnit\Framework\TestCase;
use Game\Skills\SkillFactory;
use Game\Player;
use Game\GameSettings;

class SkillTest extends TestCase
{

    /** @var $skillMagicShield */
    protected $skillMagicShield;

    /** @var $skillRapidStrike */
    protected $skillRapidStrike;

    /**
     * Set up test for livingEntity
     */
    protected function setUp()
    {
        $this->skillMagicShield = SkillFactory::createSkill("MAGIC_SHIELD",GameSettings::PLAYER_ATTRIBUTES['SKILLS']['MAGIC_SHIELD']);
        $this->skillRapidStrike = SkillFactory::createSkill("RAPID_STRIKE",GameSettings::PLAYER_ATTRIBUTES['SKILLS']['RAPID_STRIKE']);
    }

    
    /**
     * Test SkillFactory
     */
    public function testSkillFactory()
    {
        self::assertInstanceOf('Game\Skills\SkillMagicShield',$this->skillMagicShield);
        self::assertInstanceOf('Game\Skills\SkillRapidStrike',$this->skillRapidStrike);
    }

    
    /**
     * Test SkillMagicShield
     */
    public function testSkillMagicShield()
    {
        $livingEntity = new Player(false);

        $this->skillMagicShield->setChance(100); //set Chance to 100% so the skill is used
        $damageBeforeSpell = 100;
        $damageAfterSpell = $this->skillMagicShield->castSkill($livingEntity,$livingEntity,['damage'=>$damageBeforeSpell],false);
        self::assertEquals(50,$damageAfterSpell);

        $this->skillMagicShield->setChance(0); //set Chance to 0% so the skill is not used
        $damageBeforeSpell = 100;
        $damageAfterSpell = $this->skillMagicShield->castSkill($livingEntity,$livingEntity,['damage'=>$damageBeforeSpell],false);
        self::assertEquals(100,$damageAfterSpell);

    }

    /**
     * Test SkillRapidStrike
     */
    public function testSkillRapidStrike()
    {
        $livingEntity = new Player(false);

        $this->skillRapidStrike->setChance(100); //set Chance to 100% so the skill is used
        $damageBeforeSpell = 100;
        $damageAfterSpell = $this->skillRapidStrike->castSkill($livingEntity,$livingEntity,['damage'=>$damageBeforeSpell],false);
        self::assertEquals(200,$damageAfterSpell);

        $this->skillRapidStrike->setChance(0); //set Chance to 0% so the skill is not used
        $damageBeforeSpell = 100;
        $damageAfterSpell = $this->skillRapidStrike->castSkill($livingEntity,$livingEntity,['damage'=>$damageBeforeSpell],false);
        self::assertEquals(100,$damageAfterSpell);

    }

}
