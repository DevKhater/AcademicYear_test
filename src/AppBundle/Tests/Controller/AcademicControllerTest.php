<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

@trigger_error('Your deprecation message', E_USER_DEPRECATED);

class AcademicControllerTest extends WebTestCase
{

    public function testgetNameByYearAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/name/2014');

        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("2014\/15")')->count()
        );

        $crawler2 = $client->request('GET', '/api/name/2012');

        $this->assertEquals(
                1, $crawler2->filter('html:contains("null")')->count()
        );
    }

    public function testgetYearByDateAction()
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/api/date/2018-01-01');
        $this->assertEquals(
                1, $crawler->filter('html:contains("null")')->count()
        );
    }

    public function testgetTermNameAction()
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/api/name/2015/1');
        //$this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Autumn")')->count()
        );
    }

    public function testgetTermNameAction2()
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/api/name/2015/4');
        //$this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Error")')->count()
        );
    }

    public function testgetTermInYearAction()
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/api/terms/2015');

        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("name")')->count()
        );
    }

}
