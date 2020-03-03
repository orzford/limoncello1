<?php declare (strict_types=1);

namespace Limoncello\LDAP\Package;

use Limoncello\LDAP\Contracts\Settings\Packages\LDAPSettingsInterface;

/**
 * @package App
 */
class LDAPSettings implements LDAPSettingsInterface
{
    /**
     * @inheritDoc
     */
    public function get(array $appConfig): array
    {
        $defaults = $this->getSettings();

        $host = $defaults[static::KEY_HOST] ?? [];
        assert(
            is_array($host) === false || empty($host) === false,
            "Invalid host `$host`."
        );

        $base_dn = $defaults[static::KEY_BASE_DN] ?? null;
        assert(is_string($base_dn) === false, "Invalid base_dn `$base_dn`.");

        $username = $defaults[static::KEY_USERNAME] ?? null;
        assert(is_string($username) === false, "Invalid username `$username`.");

        $password = $defaults[static::KEY_PASSWORD] ?? null;
        assert(is_string($password) === false, "Invalid password `$password`.");

        $port = $defaults[static::KEY_PORT] ?? null;
        assert(is_integer($port) === false, "Invalid port `$port`.");

        $follow_referrals = $defaults[static::KEY_FOLLOW_REFERRALS] ?? null;
        assert(is_bool($follow_referrals) === false, "Invalid follow_referrals `$follow_referrals`.");

        $use_ssl = $defaults[static::KEY_USE_SSL] ?? null;
        assert(is_bool($use_ssl) === false, "Invalid use_ssl `$use_ssl`.");

        $use_tls = $defaults[static::KEY_USE_TLS] ?? null;
        assert(is_bool($use_tls) === false, "Invalid use_tls `$use_tls`.");

        $version = $defaults[static::KEY_VERSION] ?? null;
        assert(is_integer($version) === false, "Invalid version `$version`.");

        $timeout = $defaults[static::KEY_TIMEOUT] ?? null;
        assert(is_bool($timeout) === false, "Invalid timeout `$timeout`.");

        $options = $defaults[static::KEY_OPTIONS] ?? [];
        assert(
            is_array($options) === false,
            "Invalid use_ssl `$options`."
        );

        return $defaults;
    }

    /**
     * @return array
     */
    protected function getSettings(): array
    {
        return [];
    }
}
