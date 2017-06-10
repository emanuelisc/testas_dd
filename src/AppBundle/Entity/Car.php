<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="cars")
 * @ORM\Entity()
 */
class Car
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="brand", type="string", length=20)
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Brand must be at least {{ limit }} characters long",
     *      maxMessage = "Brand cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-z A-Z]+$/i",
     *     htmlPattern = "^[a-z A-Z]+$",
     *     match=true,
     *     message="Brand cannot contain a number or symbols(!$%^&*()_+|~=`{}\[\]:;'<>?,.\/)"
     * )
     */
    private $brand;

    /**
     * @ORM\Column(name="model", type="string", length=20)
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Model must be at least {{ limit }} characters long",
     *      maxMessage = "Model cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[a-z A-Z 0-9]+$/i",
     *     htmlPattern = "^[a-z A-Z 0-9]+$",
     *     match=true,
     *     message="Modal cannot contain a symbols(!$%^&*()_+|~=`{}\[\]:;'<>?,.\/)"
     * )
     */
    private $model;

    /**
     * @ORM\Column(name="millage", type="integer")
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $millage;

    /**
     * @ORM\Column(name="standing", type="integer")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $standing;

    /**
     * @ORM\Column(name="discharging", type="integer")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $discharging;

    /**
     * @ORM\Column(name="driving", type="integer")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $driving;

    /**
     * @ORM\Column(name="height", type="integer")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $height;

    /**
     * @ORM\Column(name="length", type="integer")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $length;

    /**
     * @ORM\Column(name="width", type="integer")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $width;

    /**
     * @ORM\Column(name="maxWeight", type="integer")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/i",
     *     htmlPattern = "^[0-9]*$",
     *     match=true,
     *     message="This field must contain only integer type number"
     * )
     */
    private $maxWeight;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="car", cascade={"remove"})
     */
    private $orders;

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
     * Set brand
     *
     * @param string $brand
     *
     * @return Car
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set milage
     *
     * @param integer $millage
     *
     * @return Car
     */
    public function setMillage($millage)
    {
        $this->millage = $millage;

        return $this;
    }

    /**
     * Get milage
     *
     * @return integer
     */
    public function getMillage()
    {
        return $this->millage;
    }

    /**
     * Set standing
     *
     * @param integer $standing
     *
     * @return Car
     */
    public function setStanding($standing)
    {
        $this->standing = $standing;

        return $this;
    }

    /**
     * Get standing
     *
     * @return integer
     */
    public function getStanding()
    {
        return $this->standing;
    }

    /**
     * Set discharging
     *
     * @param integer $discharging
     *
     * @return Car
     */
    public function setDischarging($discharging)
    {
        $this->discharging = $discharging;

        return $this;
    }

    /**
     * Get discharging
     *
     * @return integer
     */
    public function getDischarging()
    {
        return $this->discharging;
    }

    /**
     * Set driving
     *
     * @param integer $driving
     *
     * @return Car
     */
    public function setDriving($driving)
    {
        $this->driving = $driving;

        return $this;
    }

    /**
     * Get driving
     *
     * @return integer
     */
    public function getDriving()
    {
        return $this->driving;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Car
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set length
     *
     * @param integer $length
     *
     * @return Car
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Car
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set maxWeight
     *
     * @param integer $maxWeight
     *
     * @return Car
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;

        return $this;
    }

    /**
     * Get maxWeight
     *
     * @return integer
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * Set order
     *
     * @param \AppBundle\Entity\Order $order
     *
     * @return Car
     */
    public function addOrder(\AppBundle\Entity\Order $order = null)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    public function getParameters(){
        return $this->brand." ".$this->model." ".$this->length."x".$this->width."x".$this->height;
    }
}
