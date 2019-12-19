<?php declare (strict_types=1);

namespace Orzford\Limoncello\Tests\Types;

use Doctrine\DBAL\Types\Type;
use Orzford\Limoncello\Flute\Types\UuidType;
use Orzford\Limoncello\Tests\Flute\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @package App
 */
class UuidTypesTest extends TestCase
{
    /**
     * @inheritDoc
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function setUp()
    {
        parent::setUp();

        if (Type::hasType(UuidType::NAME) === false) {
            Type::addType(UuidType::NAME, UuidType::class);
        }
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testUuidTypeConversions(): void
    {
        $type = Type::getType(UuidType::NAME);

        $platform = $this->createConnection()->getDatabasePlatform();

        $uuid = 'ff6f8cb0-c57d-11e1-9b21-0800200c9a66';
        /** @var Uuid $phpValue */
        $phpValue = $type->convertToPHPValue($uuid, $platform);

        $this->assertEquals('ff6f8cb0-c57d-11e1-9b21-0800200c9a66', $phpValue);
        $this->assertEquals($uuid, $phpValue->jsonSerialize());
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testUuidTypeToDatabaseConversions(): void
    {
        $type = Type::getType(UuidType::NAME);

        $platform = $this->createConnection()->getDatabasePlatform();

        $uuid = 'ff6f8cb0-c57d-11e1-9b21-0800200c9a66';

        /** @var string $databaseValue */
        $databaseValue = $type->convertToDatabaseValue($uuid, $platform);
        $this->assertEquals('ff6f8cb0-c57d-11e1-9b21-0800200c9a66', $databaseValue);
    }
}
