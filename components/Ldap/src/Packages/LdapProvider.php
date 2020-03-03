<?php declare (strict_types=1);

namespace Orzford\Limoncello\Ldap\Packages;

use Limoncello\Contracts\Provider\ProvidesContainerConfiguratorsInterface;
use Limoncello\Ldap\Packages\LdapContainerConfigurator;

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
