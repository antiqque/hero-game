<?php

namespace Game;

abstract class Entity
{
    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Npc
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}