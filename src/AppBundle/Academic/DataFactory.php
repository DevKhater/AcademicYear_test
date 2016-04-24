<?php

namespace AppBundle\Academic;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\FileLocator;

class DataFactory
{

    private $data;

    public function read($location)
    {
        $fileLocator = new FileLocator();
        $path = $fileLocator->locate($location);
        $this->data = new Parser();
        try {
            $this->data = Yaml::parse(file_get_contents($path));
        } catch (ParseException $e) {
            printf("Error In Yaml File, fix the file and retry. Unable to parse the YAML string: %s", $e->getMessage());
            exit;
        }
    }

    public function getYear($year)
    {
        $k = array_search($year, array_column($this->data['academic'], 'year'));
        if ($k === false) {
            return null;
        }
        return $this->data['academic'][$k];
    }

    public function getAcademicYearByDate($un_stamp)
    {
        $keys = array_keys($this->data['academic']);
        for ($i = 0; $i <= (count($keys) - 1); $i++) {
            $cur = $this->data['academic'][$keys[$i]];
            if ($i != (count($keys) - 1)) {
                $next = $this->data['academic'][$keys[$i + 1]];
                $end_date = $this->data['academic'][$keys[$i + 1]]['start'];
                if ($this->data['academic'][$keys[$i]]['start'] <= $un_stamp && $un_stamp < $this->data['academic'][$keys[$i + 1]]['start']) {
                    return $cur;
                }
            } elseif ($this->data['academic'][$keys[$i]]['start'] <= $un_stamp && $un_stamp < end($this->data['academic'][$keys[$i]]['terms'])['end']) {
                return $cur;
            }
        }
        return null;
    }

}
