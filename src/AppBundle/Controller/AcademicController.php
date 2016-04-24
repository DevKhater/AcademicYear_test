<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

//use AppBundle\Academic\AcademicFactory;


class AcademicController extends FOSRestController
{

    protected function loadData()
    {
        $academic = $this->get('academic_manager');
        $academic->load($this->container->get('kernel')->locateResource('@AppBundle/Resources/data2.yml'));
        return $academic;
    }

    /**
     * Get Academic Year Name by providing Academic Year
     *
     * @ApiDoc(
     *  resource=true,
     *  description="",
     *  filters={
     *      {"name"="year", "dataType"="year"}   
     *  }
     * )
     *
     * /

      /*
     * GET Route annotation.
     * @Get("name/{year}")

     */
    public function getNameByYearAction($year)
    {
        $academic = $this->loadData();
        $data = $academic->getNameByYear($year);
        $serializedEntity = $this->container->get('serializer')->serialize($data, 'json');
        return new Response($serializedEntity);
    }

    /**
     * Get Academic Year by providing a date
     *
     * @ApiDoc(
     *  resource=true,
     *  description="",
     *  filters={
     *      {"name"="date", "dataType"="date"}   
     *  }
     * )
     *
     * /

      /**
     * GET Route annotation.
     * @Get("date/{date}")
     */
    public function getYearByDateAction($date)
    {
        $academic = $this->loadData();
        $data = $academic->getByDate(strtotime($date));
        $serializedEntity = $this->container->get('serializer')->serialize($data, 'json');
        return new Response($serializedEntity);
    }

    /**
     * Get term number of days by providing a year and the term number.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="",
     *  filters={
     *      {"name"="year", "dataType"="year"},   
     *      {"name"="term", "dataType"="int"},   
     *  }
     * )
     *
     * /

      /**
     * GET Route annotation.
     * @Get("days/{year}/{term}")
     */
    public function getTermDurationAction($year, $term)
    {
        $academic = $this->loadData();
        $data = $academic->getTermLength($year, $term);
        $serializedEntity = $this->container->get('serializer')->serialize($data, 'json');
        return new Response($serializedEntity);
    }

    /**
     * Get term name by providing a year and the term number.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="",
     *  filters={
     *      {"name"="year", "dataType"="year"},   
     *      {"name"="term", "dataType"="int"},   
     *  }
     * )
     *
     * /


      /**
     * GET Route annotation.
     * @Get("name/{year}/{term}")
     */
    public function getTermNameAction($year, $term)
    {
        $academic = $this->loadData();
        $data = $academic->getTermName($year, $term);
        $serializedEntity = $this->container->get('serializer')->serialize($data, 'json');
        return new Response($serializedEntity);
    }

    /**
     * Get All terms information by providing a year.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="",
     *  filters={
     *      {"name"="year", "dataType"="year"},
     *  }
     * )
     *
     * /

      /**
     * GET Route annotation.
     * @Get("terms/{year}")
     */
    public function getTermInYearAction($year)
    {
        $academic = $this->loadData();
        $data = $academic->getTerms($year);
        $serializedEntity = $this->container->get('serializer')->serialize($data, 'json');
        return new Response($serializedEntity);
    }

}
