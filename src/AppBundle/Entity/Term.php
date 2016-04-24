<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Term
{

    /**
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Assert\Date(message="Invalid Start Date")
     * @Assert\Expression(
     *     "this.startDate <= this.endDate",
     *      message="Start date should be before end date!"
     * )
     */
    private $startDate;

    /**
     * @Assert\Date(message="Invalid End Date")
     * @Assert\Expression(
     *     "this.startDate <= this.endDate",
     *      message="End date should be after start date!"
     * )
     */
    private $endDate;
    
    /**
     * @Assert\Type(
     *     type="integer",
     * )
     */
    private $numberOfDays;

    public function __construct($name, $startDate, $endDate)
    {
        $this->name = ucwords(str_replace('_', ' ', $name));
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->numberOfDays = intval(floor((strtotime($this->endDate) - strtotime($this->startDate)) / (60 * 60 * 24)));
    }

    function getName()
    {
        return $this->name;
    }

    function getStartDate()
    {
        return $this->startDate;
    }

    function getEndDate()
    {
        return $this->endDate;
    }

    function getTermDuration()
    {
        return $this->numberOfDays;
    }

}
