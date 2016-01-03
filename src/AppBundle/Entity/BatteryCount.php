<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BatteryCount
 *
 * @ORM\Table(name="battery_count")
 * @ORM\Entity
 */
class BatteryCount
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
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="battery_countid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="battery_count_battery_countid_seq", allocationSize=1, initialValue=1)
     */
    private $batteryCountid;



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
    public function getType()
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
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return BatteryCount
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get batteryCountid
     *
     * @return integer
     */
    public function getBatteryCountid()
    {
        return $this->batteryCountid;
    }
}
