<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Term as Term;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class Year
{

    /**
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Assert\Date()
     */
    private $year;

    /**
     * @Assert\Date(message="Invalid Start Date")
     */
    private $yearStartDate;
    
    
    private $terms;

    public function __construct($year, $name, $yearStartDate)
    {
        $this->year = $year;
        $this->name = $name;
        $this->yearStartDate = $yearStartDate;
        $this->terms = new ArrayCollection();
    }

    public function addTerm(Term $term)
    {
        $this->terms[] = $term;
    }
    
    function getYear()
    {
        return $this->year;
    }

    function getName()
    {
        return $this->name;
    }
    
    public function getNumberofTerms()
    {
        return count($this->terms);
    }

    function getYearStartDate()
    {
        return $this->yearStartDate;
    }

    function getTerms()
    {
        return $this->terms;
    }

    function getTerm($id)
    {
        return $this->terms[$id];
    }

}
