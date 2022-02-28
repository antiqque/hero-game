<?php


namespace Game\Skills;

class Skill{

    const DEFENSIVE=0;
    const OFFENSIVE=1;

    private $name;
    private $description;
    private $chance;

    private $type;



    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Skill
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Skill
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getChance()
    {
        return $this->chance;
    }

    /**
     * @param int $chance
     * @return Skill
     */
    public function setChance($chance)
    {
        $this->chance = $chance;
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Skill
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}