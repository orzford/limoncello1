<?php declare (strict_types=1);

namespace Limoncello\LDAP\Packages;

use Limoncello\Contracts\Provider\ProvidesContainerConfiguratorsInterface;

/**
 * @package App
 */
class LDAPProvider implements ProvidesContainerConfiguratorsInterface
{
    /**
     * @inheritDoc
     */
    public static function getContainerConfigurators(): array
    {
        return [
            LDAPContainerConfigurator::class,
        ];
    }
}
