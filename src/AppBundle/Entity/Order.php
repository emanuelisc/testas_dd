<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="orders")
 * @ORM\Entity()
 */
class Order
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
     * @ORM\Column(name="dateToDeliver", type="date")
     * @Assert\Date()
     */
    private $dateToDeliver;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Address must be at least {{ limit }} characters long",
     *      maxMessage = "Address cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Regex(
     *     pattern="/^[a-z A-Z 0-9 .,']+$/i",
     *     htmlPattern = "^[a-z A-Z0-9 .,']+$",
     *     match=true,
     *     message="Address cannot contain a symbols(!$%^&*()_+|~=-`{}:;<>?/[])"
     * )
     */
    private $address;

    /**
     * @ORM\OneToOne(targetEntity="Driver", inversedBy="order")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driver;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Car", inversedBy="orders")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id", nullable=true)
     */
    private $car;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

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
     * Set dataToDeliver
     *
     * @param \DateTime $dateToDeliver
     *
     * @return Order
     */
    public function setDateToDeliver($dateToDeliver)
    {
        $this->dateToDeliver = $dateToDeliver;

        return $this;
    }

    /**
     * Get dataToDeliver
     *
     * @return \DateTime
     */
    public function getDateToDeliver()
    {
        return $this->dateToDeliver;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Order
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Order
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

//    /**
//     * @param mixed $driver
//     */
//    public function setDriver($driver = null)
//    {
//        $this->driver = $driver;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getDriver()
//    {
//        return $this->driver;
//    }

    /**
     * @param mixed $car
     */
    public function setCar($car)
    {
        $this->car = $car;
    }

    /**
     * @return mixed
     */
    public function getCar()
    {
        return $this->car;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }
}
