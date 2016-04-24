<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\DataFactory;
use AppBundle\Entity\DataGateway;
use AppBundle\Entity\DataRepository;

class DataRepositoryTest extends \PHPUnit_Framework_TestCase
{
    const CONTENT = 'Test';

    private $repository;

    public function setUp()
    {
        $filename = 'data2.yml';
        $gateway = new DataGateway($filename);
        $factory = new DataFactory();
        $this->repository = new DataRepository($gateway, $factory);
    }

    public function testItPersistsTheData()
    {
        $quote = $this->repository->insert(self::CONTENT);
        $id = $quote['quote']['id'];
        $quotes = $this->repository->findAll();
        $foundQuote = $quotes['quotes'][$id];

        $this->assertSame(self::CONTENT, $foundQuote['content']);
    }
}