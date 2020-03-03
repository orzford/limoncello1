<?php declare (strict_types=1);

namespace Limoncello\Ldap\Packages;

use Limoncello\Contracts\Provider\ProvidesContainerConfiguratorsInterface;

/**
 * @package App
 */
class LdapProvider implements ProvidesContainerConfiguratorsInterface
{
    /**
     * @inheritDoc
     */
    public static function getContainerConfigurators(): array
    {
        return [
            LdapContainerConfigurator::class,
        ];
    }
}
