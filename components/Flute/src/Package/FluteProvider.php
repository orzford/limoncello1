<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Package;

use Limoncello\Contracts\Provider\ProvidesContainerConfiguratorsInterface;

/**
 * @package App
 */
class FluteProvider implements ProvidesContainerConfiguratorsInterface
{
    /**
     * @inheritDoc
     */
    public static function getContainerConfigurators(): array
    {
        return [
            FluteContainerConfigurator::class,
        ];
    }
}
