<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Validation\JsonApi\Rules;

use Doctrine\DBAL\Connection;
use Limoncello\Validation\Contracts\Execution\ContextInterface;
use Limoncello\Validation\Rules\ExecuteRule;
use Orzford\Limoncello\Flute\Contracts\Http\Query\RouteIndexInterface;
use Orzford\Limoncello\Flute\Contracts\Validation\ErrorCodes;
use Orzford\Limoncello\Flute\L10n\Messages;

/**
 * @package App
 */
final class UniqueConstraintWithDoctrineRule extends ExecuteRule
{
    /**
     * Property key
     */
    const PROPERTY_TABLE_NAME = self::PROPERTY_LAST + 1;
    /**
     * Property key
     */
    const PROPERTY_PRIMARY_NAME = self:: PROPERTY_TABLE_NAME + 1;
    /**
     * Property key
     */
    const PROPERTY_PRIMARY_KEY = self::PROPERTY_PRIMARY_NAME + 1;

    /**
     * @inheritDoc
     */
    public function __construct(string $tableName, string $primaryName, ?string $primaryKey = null)
    {
        parent::__construct([
            static::PROPERTY_TABLE_NAME   => $tableName,
            static::PROPERTY_PRIMARY_NAME => $primaryName,
            static::PROPERTY_PRIMARY_KEY  => $primaryKey,
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function execute($value, ContextInterface $context): array
    {
        $found = false;

        if (is_scalar($value) === true) {
            /** @var Connection $connection */
            $connection = $context->getContainer()->get(Connection::class);
            $builder = $connection->createQueryBuilder();

            $tableName = $context->getProperties()->getProperty(static::PROPERTY_TABLE_NAME);
            $primaryName = $context->getProperties()->getProperty(static::PROPERTY_PRIMARY_NAME);
            $primaryKey = $context->getProperties()->getProperty(static::PROPERTY_PRIMARY_KEY);

            $columnNames = isset($primaryKey) ? "`{$primaryKey}`, `{$primaryName}`" : "`{$primaryName}`";

            $statement = $builder
                ->select($columnNames)
                ->from($tableName)
                ->where($builder->expr()->eq($primaryName, $builder->createPositionalParameter($value)))
                ->setMaxResults(1);

            $fetched = $statement->execute()->fetch();

            /** @var RouteIndexInterface $routeIndex */
            $routeIndex = $context->getContainer()->get(RouteIndexInterface::class);

            $found = isset($primaryKey) ?
                $fetched !== false && $fetched[$primaryKey] !== $routeIndex->getIndex() :
                $fetched !== false;
        }

        $reply = $found === false ?
            static::createSuccessReply($value) :
            static::createErrorReply(
                $context,
                $value,
                ErrorCodes::UNIQUE_IN_DATABASE_SINGLE,
                Messages::UNIQUE_IN_DATABASE_SINGLE,
                []
            );

        return $reply;
    }
}
