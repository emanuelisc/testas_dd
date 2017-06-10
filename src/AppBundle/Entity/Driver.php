<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="driver")
 * @ORM\Entity()
 */
class Driver
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="whenLeaveTerminal", type="time", nullable=true)
     * @Assert\Time()
     */
    private $whenLeaveTerminal;

    /**
     * @ORM\Column(name="whenCameToCustomer", type="time", nullable=true)
     * @Assert\Time()
     */
    private $whenCameToCustomer;

    /**
     * @var int
     *
     * @ORM\Column(name="whenLoadOut", type="integer", nullable=true)
     * * @Assert\Regex(
     *     pattern="/^[0-9 0-9 \-]*$/i",
     *     htmlPattern = "^[0-9 0-9 \-]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $whenLoadOut;

    /**
     * @ORM\Column(name="whenLeaveCustomer", type="time", nullable=true)
     * @Assert\Time()
     */
    private $whenLeaveCustomer;

    /**
     * @ORM\Column(name="whenCameToTerminal", type="time", nullable=true)
     * @Assert\Time()
     */
    private $whenCameToTerminal;

    /**
     * @ORM\Column(name="distance", type="integer", nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9 0-9\-]*$/i",
     *     htmlPattern = "^[0-9 0-9\-]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $distance;

    /**
     * @ORM\Column(name="mileageBefore", type="integer", nullable=true)
     */
    private $mileageBefore;

    /**
     * @ORM\Column(name="mileageNow", type="integer", nullable=true)
     */
    private $mileageNow;
    /**
     * @ORM\OneToOne(targetEntity="Order", mappedBy="driver")
     */
    private $order;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set whenLeftTerminal
     *
     * @param \DateTime $whenLeaveTerminal
     *
     * @return Driver
     */
    public function setWhenLeaveTerminal($whenLeaveTerminal)
    {
        $this->whenLeaveTerminal = $whenLeaveTerminal;

        return $this;
    }

    /**
     * Get whenLeaveTerminal
     *
     * @return \DateTime
     */
    public function getWhenLeaveTerminal()
    {
        return $this->whenLeaveTerminal;
    }

    /**
     * Set whenCameToCustomer
     *
     * @param \DateTime $whenCameToCustomer
     *
     * @return Driver
     */
    public function setWhenCameToCustomer($whenCameToCustomer)
    {
        $this->whenCameToCustomer = $whenCameToCustomer;

        return $this;
    }

    /**
     * Get whenCameToCustomer
     *
     * @return \DateTime
     */
    public function getWhenCameToCustomer()
    {
        return $this->whenCameToCustomer;
    }

    /**
     * Set whenLoadOut
     *
     * @param integer $whenLoadOut
     *
     * @return Driver
     */
    public function setWhenLoadOut($whenLoadOut)
    {
        $this->whenLoadOut = $whenLoadOut;

        return $this;
    }

    /**
     * Get whenLoadOut
     *
     * @return integer
     */
    public function getWhenLoadOut()
    {
        return $this->whenLoadOut;
    }

    /**
     * Set whenLiveCustomer
     *
     * @param \DateTime $whenLeaveCustomer
     *
     * @return Driver
     */
    public function setWhenLeaveCustomer($whenLeaveCustomer)
    {
        $this->whenLeaveCustomer = $whenLeaveCustomer;

        return $this;
    }

    /**
     * Get whenLiveCustomer
     *
     * @return \DateTime
     */
    public function getWhenLeaveCustomer()
    {
        return $this->whenLeaveCustomer;
    }

    /**
     * Set whenCameToTerminal
     *
     * @param \DateTime $whenCameToTerminal
     *
     * @return Driver
     */
    public function setWhenCameToTerminal($whenCameToTerminal)
    {
        $this->whenCameToTerminal = $whenCameToTerminal;

        return $this;
    }

    /**
     * Get whenCameToTerminal
     *
     * @return \DateTime
     */
    public function getWhenCameToTerminal()
    {
        return $this->whenCameToTerminal;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Set distance
     *
     * @param integer $distance
     *
     * @return Driver
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return integer
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set mileageBefore
     *
     * @param integer $mileageBefore
     *
     * @return Driver
     */
    public function setMileageBefore($mileageBefore)
    {
        $this->mileageBefore = $mileageBefore;

        return $this;
    }

    /**
     * Get mileageBefore
     *
     * @return integer
     */
    public function getMileageBefore()
    {
        return $this->mileageBefore;
    }

    /**
     * Set mileageNow
     *
     * @param integer $mileageNow
     *
     * @return Driver
     */
    public function setMileageNow($mileageNow)
    {
        $this->mileageNow = $mileageNow;

        return $this;
    }

    /**
     * Get mileageNow
     *
     * @return integer
     */
    public function getMileageNow()
    {
        return $this->mileageNow;
    }
}
