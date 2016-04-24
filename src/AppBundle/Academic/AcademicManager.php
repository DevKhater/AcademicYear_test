<?php

namespace AppBundle\Academic;

use AppBundle\Academic\AcademicFactory;

class AcademicManager
{

    private $academicFactory;

    public function __construct()
    {
        $this->academicFactory = new AcademicFactory();
    }

    public function load($location)
    {
        $this->academicFactory->load($location);
    }

    public function getNameByYear($year)
    {
        $df = $this->academicFactory->getAcademicByYear($year);
        if (is_null($df)) {
            return null;
        }
        return $df->getName();
    }

    public function getTermLength($year, $term)
    {
        $df = $this->academicFactory->getAcademicByYear($year);
        if (is_null($df)) {
            return null;
        }
        $df_term = $this->checkTermValidation($term, $df);
        if (is_null($df_term)) {
            return 'Error: There is ' . count($df->getTerms()) . ' Terms in the Academic Year ' . $df->getName();
        }
        return $df_term->getTermDuration();
    }

    public function getByDate($date)
    {
        if (!is_int($date))
            $date = strtotime($date);
        $df = $this->academicFactory->getAcademicByDate($date);
        return $df;
    }

    public function getTerms($year)
    {
        $df = $this->academicFactory->getAcademicByYear($year);
        if (is_null($df)) {
            return null;
        }
        return $df->getTerms();
    }

    public function getTerm($year, $term)
    {
        $df = $this->academicFactory->getAcademicByYear($year);
        if (is_null($df)) {
            return null;
        }
        $df_term = $this->checkTermValidation($term, $df);
        if ($df_term == NULL) {
            return null;
        }
        return $df_term;
    }

    public function getTermName($year, $term)
    {
        $df = $this->academicFactory->getAcademicByYear($year);
        if (is_null($df)) {
            return null;
        }
        $df_year_name = $df->getName();
        $df_term = $this->checkTermValidation($term, $df);
        if (is_null($df_term)) {
            return 'Error: There is ' . count($df->getTerms()) . ' Terms in the Academic Year ' . $df->getName();
        }
        return $df_term->getName() . " " . $df_year_name;
    }

    protected function checkTermValidation($term, $df)
    {
        if (count($df->getTerms()) >= $term) {
            $df_term = $df->getTerm($term - 1);
            return $df_term;
        }
        return null;
    }

}
