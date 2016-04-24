<?php

namespace AppBundle\Academic;

use AppBundle\Academic\DataFactory;
use AppBundle\Entity\Year;
use AppBundle\Entity\Term;

class AcademicFactory
{

    public function __construct()
    {
        $this->dataFactory = new DataFactory();
    }

    public function load($location)
    {
        $this->dataFactory->read($location);
    }

    public function getAcademicByDate($date)
    {
        $df = $this->dataFactory->getAcademicYearByDate($date);
        return $this->createYearEntity($df);
    }

    public function getAcademicByYear($year)
    {
        $df = $this->dataFactory->getYear($year);
        return $this->createYearEntity($df);
    }

    protected function createYearEntity($df)
    {
        if (is_null($df)) {
            return null;
        }
        $theYear = new Year($df['year'], $df['name'], date("Y-m-d", $df['start']));
        $terms = $df['terms'];
        foreach ($terms as $term) {
            $theTerm = new Term($term['name'], date("Y-m-d", $term['start']), date("Y-m-d", $term['end']));
            $theYear->addTerm($theTerm);
        }
        return $theYear;
    }

}
