<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Academic\AcademicFactory;



class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //$fileLocator = $this->get('file_locator');
//        $manager = new AcademicFactory();
//        dump($manager->get());
        
        $academic = $this->get('academic_manager');
        $academic->load($this->container->get('kernel')->locateResource('@AppBundle/Resources/data2.yml'));
        
        //dump($academic->getByYear('2015'));
        dump($academic->getTermName(2016,3));
        //dump($academic->getTerm('2015', 3));
        
        
        
//        $fileLocator = $this->get('file_locator');
//        $path = $fileLocator->locate('@AppBundle/Resources/data2.yml');
//        $yaml = new Parser();
//        try {
//            //$value = $yaml->parse(file_get_contents($path));
//            $yaml = Yaml::parse(file_get_contents($path));
//        } catch (ParseException $e) {
//            printf("Unable to parse the YAML string: %s", $e->getMessage());
//        }
//        $alldata = new Data();
//        $total_years = count($yaml['academic']);
//        foreach ($yaml['academic'] as $theYear) {
//            $year = new Year($theYear['year'], date("Y-m-d", $theYear['start']));
//            $errors = $this->ValidateYaml($year);
//            if (count($errors) > 0) {
//                foreach ($errors as $error) {
//                    //echo "<pre>";
//                    return new Response(print_r($error->getMessage(), true));
//                }
//            }
//            $terms = $theYear['terms'];
//            foreach ($terms as $key => $value) {
//                $theTerm = new Term($key, date("Y-m-d", $value['start']), date("Y-m-d", $value['end']));
//                //$value['end']);
//                $errors = $this->ValidateYaml($theTerm);
//                if (count($errors) > 0) {
//                    foreach ($errors as $error) {
//                        //echo "<pre>";
//                        return new Response(print_r($error->getMessage(), true));
//                    }
//                }
//                $year->addTerm($theTerm);
//            }
//            $alldata->addAcademicYear($year);
//        }
//
//        var_dump($alldata);
//        dump($alldata);
//        echo "<pre>";
//        var_dump($alldata->getFirst());
//        
//        $k =  array_search('2015/2016', array_column($alldata, 'year')); 
//        if ($k == false ) {
//            echo "No Result FOund";
//            exit;
//        }
//        echo $k;
//        var_dump($alldata->getYears());
        
        
        
        
//        $year = new Year($yaml['academic'][0]['year'], date("Y-m-d", $yaml['academic'][0]['start']));
//        $validator = $this->get('validator');
//        $errors = $validator->validate($year);
//    if (count($errors) > 0) {
//        foreach ($errors as $error) {
//            echo "<pre>";
//            return new Response(print_r($error->getMessage(), true));
//        }
//    } else {
//        return new Response('The Academic Year is valid! Yes!');
//    }
//        $erms = $yaml['academic'][2]['terms'];
//        foreach ($erms as $key => $value) {
//            $theTerm = new Term($key, date("Y-m-d", $value['start']), date("Y-m-d", $value['end']));
//            //$value['end']);
//            $validator = $this->get('validator');
//            $errors = $validator->validate($theTerm);
//            if (count($errors) > 0) {
//                foreach ($errors as $error) {
//                    return new Response(print_r($error->getMessage() . " Please Correct the Yaml File in the Academic Year : " . $year->getYearName(), true));
//                }
//            } else {
//                $year->addTerm($theTerm);
//            }
//        }
//        dump($year);

        /*         * *    SEARCH THE ARRAY ** */
//        $k =  array_search('2015/2016', array_column($yaml['academic'], 'year')); 
//        if ($k == false ) {
//            echo "No Result FOund";
//            exit;
//        }
        //echo $k;
        //var_dump($yaml['academic'][$k]['start']);
        //
         /*         * * CALUCLATE DURATIONS *** */
//        echo date("Y-m-d", $yaml['academic'][$k]['start']);
//        $start = strtotime(date("Y-m-d", $yaml['academic'][$k]['start']));
//        echo $start . '<br/>';
//        $end = strtotime(date("Y-m-d", $yaml['academic'][$k]['terms']['semester']['spring']['end']));
//        echo $end. '<br/>';
//        $days_between = ceil(abs($end - $start) / 86400);
//        echo $days_between/7;
        //dump($yaml['academic'][0]);

        return $this->render('default/index.html.twig', array(
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    protected function ValidateYaml($data)
    {
        $validator = $this->get('validator');
        $errors = $validator->validate($data);
        return $errors;
    }

}
