<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BatteryCount
 *
 * @ORM\Table(name="battery_count")
 * @ORM\Entity
 */
class BatteryCountOutput
{
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="text", nullable=true)
     */
    private $type;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     */
    private $count;
    
    /**
     * Set type
     *
     * @param string $type
     *
     * @return BatteryCount
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
    
    /**
     * Get type
     *
     * @return string
     */
    public function getType($type)
    {
        return $this->type;
    }
    
    /**
     * Set count
     *
     * @param integer $count
     *
     * @return BatteryCount
     */
    public function setCount($type)
    {
        $this->count = $count;

        return $this;
    }
    
    /**
     * Get count
     *
     * @return integer
     */
    public function getCount($type)
    {
        return $this->count;
    }
}