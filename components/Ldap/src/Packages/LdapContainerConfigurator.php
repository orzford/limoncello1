<?php declare (strict_types=1);

namespace Limoncello\Ldap\Packages;

use LdapRecord\Connection;
use LdapRecord\Connection as LdapConnection;
use Limoncello\Contracts\Commands\ContainerConfiguratorInterface;
use Limoncello\Contracts\Container\ContainerInterface;
use Limoncello\Contracts\Settings\SettingsProviderInterface;
use Limoncello\Ldap\Package\LdapSettings;
use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * @package App
 */
class LdapContainerConfigurator implements ContainerConfiguratorInterface
{
    const CONFIGURATOR = [self::class, self::CONTAINER_METHOD_NAME];

    /**
     * @inheritDoc
     */
    public static function configureContainer(ContainerInterface $container): void
    {
        $container[LdapConnection::class] = function (PsrContainerInterface $container): Connection {
            $settings = $container->get(SettingsProviderInterface::class)->get(LdapSettings::class);
            $params = array_filter([
                'host'             => $settings[LdapSettings::KEY_HOST] ?? [],
                'base_dn'          => $settings[LdapSettings::KEY_BASE_DN] ?? null,
                'username'         => $settings[LdapSettings::KEY_USERNAME] ?? null,
                'password'         => $settings[LdapSettings::KEY_PASSWORD] ?? null,
                'port'             => $settings[LdapSettings::KEY_PORT] ?? null,
                'follow_referrals' => $settings[LdapSettings::KEY_FOLLOW_REFERRALS] ?? null,
                'use_ssl'          => $settings[LdapSettings::KEY_USE_SSL] ?? null,
                'use_tls'          => $settings[LdapSettings::KEY_USE_TLS] ?? null,
                'version'          => $settings[LdapSettings::KEY_VERSION] ?? null,
                'timeout'          => $settings[LdapSettings::KEY_TIMEOUT] ?? null,
            ], function ($value) {
                return $value != null;
            });
            $options = $settings[LdapSettings::KEY_OPTIONS] ?? [];

            $connection = new LdapConnection($params + $options);

            return $connection;
        };
    }
}
