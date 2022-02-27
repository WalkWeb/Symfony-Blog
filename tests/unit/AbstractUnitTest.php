<?php

declare(strict_types=1);

namespace App\Tests\unit;

use Doctrine\DBAL\Exception;
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

    /**
     * Необходимо ли очищать изменения, внесенные в базу после каждого теста
     *
     * Существующая для этого настройка "populate: true" в unit.suite.yml по какой-то причине не работает
     *
     * TODO И новая ошибка с transaction: [Doctrine\DBAL\ConnectionException] There is no active transaction.
     * TODO https://github.com/doctrine/DoctrineMigrationsBundle/issues/393
     * TODO https://github.com/doctrine/migrations/pull/1157/files
     *
     * @var bool
     */
    protected $cleanup = false;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = $this->client->getKernel()->getContainer()->get('doctrine')->getManager();

        if ($this->cleanup) {
            $this->em->getConnection()->beginTransaction();
        }
    }

    /**
     * @throws Exception
     */
    public function tearDown(): void
    {
        parent::tearDown();

        if ($this->cleanup) {
            $this->em->getConnection()->rollback();
        }

        $this->em->getConnection()->close();
    }
}
