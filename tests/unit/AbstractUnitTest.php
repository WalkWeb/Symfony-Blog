<?php

declare(strict_types=1);

namespace App\Tests\unit;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractUnitTest extends WebTestCase
{
    /**
     * @var KernelBrowser
     */
    protected $client;

    /**
     * @var EntityManager
     */
    protected $em;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = $this->client->getKernel()->getContainer()->get('doctrine')->getManager();
    }
}
