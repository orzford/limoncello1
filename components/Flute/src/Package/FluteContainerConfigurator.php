<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Package;

use Doctrine\DBAL\Types\Type;
use Limoncello\Contracts\Container\ContainerInterface as LimoncelloContainerInterface;
use Orzford\Limoncello\Flute\Contracts\Http\Query\RouteIndexInterface;
use Orzford\Limoncello\Flute\Http\Query\RouteIndex;
use Orzford\Limoncello\Flute\Types\UuidType;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\Validator\Validator as UuidValidator;
use Ramsey\Uuid\Validator\ValidatorInterface as UuidValidatorInterface;

/**
 * @package App
 */
class FluteContainerConfigurator extends \Limoncello\Flute\Package\FluteContainerConfigurator
{
    /**
     * @inheritDoc
     */
    public static function configureContainer(LimoncelloContainerInterface $container): void
    {
        parent::configureContainer($container);

        $container[UuidFactoryInterface::class] = function (): UuidFactoryInterface {
            return Uuid::getFactory();
        };

        $container[UuidValidatorInterface::class] = function (): UuidValidatorInterface {
            return new UuidValidator();
        };

        $container[RouteIndexInterface::class] = function (PsrContainerInterface $container): RouteIndexInterface {
            return new RouteIndex($container);
        };

        Type::hasType(UuidType::NAME) === true ?: Type::addType(UuidType::NAME, UuidType::class);
    }
}
