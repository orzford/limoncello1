<?php declare (strict_types=1);

namespace Orzford\Limoncello\Tests\Flute;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Limoncello\Common\Reflection\ClassIsTrait;
use Mockery;

/**
 * @package App
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    use ClassIsTrait;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    /**
     * @return Connection
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function createConnection(): Connection
    {
        $connection = DriverManager::getConnection(['url' => 'sqlite:///', 'memory' => true]);
        $this->assertNotSame(false, $connection->exec('PRAGMA foreign_keys = ON;'));

        return $connection;
    }
}
