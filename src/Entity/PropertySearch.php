<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min=10, max=400)
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @var integer|null
     */
    private $distance;

    /**
     * @var float|null
     */
    private $lat;

    /**
     * @var float|null
     */
    private $lng;

    /**
     * @var string|null
     */
    private $address;


    /**
     * @return int|null
     */
    public function getMaxPrice() : ? int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice) : PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSurface() : ? int
    {
        return $this->minSurface;
    }

    /**
     * @param int|null $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface) : PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }


    /**
     * @return ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }


    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options) : void
    {
        $this->options = $options;
    }



    /**
     * Get the value of distance
     *
     * @return  integer|null
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set the value of distance
     *
     * @param  integer|null  $distance
     *
     * @return  self
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get the value of lng
     *
     * @return  float|null
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set the value of lng
     *
     * @param  float|null  $lng
     *
     * @return  self
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get the value of lat
     *
     * @return  float|null
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @param  float|null  $lat
     *
     * @return  self
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of address
     *
     * @return  string|null
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string|null  $address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}
