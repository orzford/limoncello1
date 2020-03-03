<?php declare (strict_types=1);

namespace Limoncello\LDAP\Packages;

use LdapRecord\Connection;
use LdapRecord\Connection as LDAPConnection;
use Limoncello\Contracts\Commands\ContainerConfiguratorInterface;
use Limoncello\Contracts\Container\ContainerInterface;
use Limoncello\Contracts\Settings\SettingsProviderInterface;
use Limoncello\LDAP\Package\LDAPSettings;
use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * @package App
 */
class LDAPContainerConfigurator implements ContainerConfiguratorInterface
{
    const CONFIGURATOR = [self::class, self::CONTAINER_METHOD_NAME];

    /**
     * @inheritDoc
     */
    public static function configureContainer(ContainerInterface $container): void
    {
        $container[LDAPConnection::class] = function (PsrContainerInterface $container): Connection {
            $settings = $container->get(SettingsProviderInterface::class)->get(LDAPSettings::class);
            $params = array_filter([
                'host'             => $settings[LDAPSettings::KEY_HOST] ?? [],
                'base_dn'          => $settings[LDAPSettings::KEY_BASE_DN] ?? null,
                'username'         => $settings[LDAPSettings::KEY_USERNAME] ?? null,
                'password'         => $settings[LDAPSettings::KEY_PASSWORD] ?? null,
                'port'             => $settings[LDAPSettings::KEY_PORT] ?? null,
                'follow_referrals' => $settings[LDAPSettings::KEY_FOLLOW_REFERRALS] ?? null,
                'use_ssl'          => $settings[LDAPSettings::KEY_USE_SSL] ?? null,
                'use_tls'          => $settings[LDAPSettings::KEY_USE_TLS] ?? null,
                'version'          => $settings[LDAPSettings::KEY_VERSION] ?? null,
                'timeout'          => $settings[LDAPSettings::KEY_TIMEOUT] ?? null,
            ], function ($value) {
                return $value != null;
            });
            $options = $settings[LDAPSettings::KEY_OPTIONS] ?? [];

            $connection = new LDAPConnection($params + $options);

            return $connection;
        };
    }
}
