<?php declare (strict_types=1);

namespace Orzford\Limoncello\Data\Migrations;

use Closure;
use Doctrine\DBAL\Schema\Table;
use Orzford\Limoncello\Flute\Types\UuidType;

/**
 * @package Orzford\Limoncello\Data\Migrations
 */
trait MigrationTrait
{
    use \Limoncello\Data\Migrations\MigrationTrait;

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function primaryUuid(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, UuidType::NAME)
                ->setNotnull(true);
            $table->setPrimaryKey([$name]);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function uuid(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, UuidType::NAME)
                ->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullableUuid(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, UuidType::NAME)
                ->setNotnull(false);
        };
    }
}
