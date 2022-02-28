<?php


namespace Game\Skills;

abstract class SkillFactory{

    static function createSkill(string $type, array $properties)
    {
        $skill = "Game\\Skills\\Skill" . str_replace('_','',ucwords($type,"_"));

        if(class_exists($skill))
        {
            return new $skill($properties);
        }
        else {
            throw new \Exception("Invalid skill type given.[".$skill."]");
        }
    }

}