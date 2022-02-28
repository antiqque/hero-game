<?php


namespace Game\Skills;

use Game\Entity;

interface SkillInterface
{
    public function __construct(array $properties);

    public function castSkill(mixed $caster, Entity $entity, array $params = [], $verbose);
    public function getSkillChance();
    public function getType();
}

