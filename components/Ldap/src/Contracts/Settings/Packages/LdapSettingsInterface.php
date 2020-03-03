<?php declare (strict_types=1);

namespace Orzford\Limoncello\Ldap\Contracts\Settings\Packages;

use Limoncello\Contracts\Settings\SettingsInterface;

/**
 * @package Orzford\Limoncello\Ldap\Contracts\Settings\Packages
 */
interface LdapSettingsInterface extends SettingsInterface
{
    /**
     * Settings key
     */
    const KEY_HOST = 0;

    /**
     * Settings key
     */
    const KEY_BASE_DN = self::KEY_HOST + 1;

    /**
     * Settings key
     */
    const KEY_USERNAME = self::KEY_BASE_DN + 1;

    /**
     * Settings key
     */
    const KEY_PASSWORD = self::KEY_USERNAME + 1;

    /**
     * Settings key
     */
    const KEY_PORT = self::KEY_PASSWORD + 1;

    /**
     * Settings key
     */
    const KEY_FOLLOW_REFERRALS = self::KEY_PORT + 1;

    /**
     * Settings key
     */
    const KEY_USE_SSL = self::KEY_FOLLOW_REFERRALS + 1;

    /**
     * Settings key
     */
    const KEY_USE_TLS = self::KEY_USE_SSL + 1;

    /**
     * Settings key
     */
    const KEY_VERSION = self::KEY_USE_TLS + 1;

    /**
     * Settings key
     */
    const KEY_TIMEOUT = self::KEY_VERSION + 1;

    /**
     * Settings key
     */
    const KEY_OPTIONS = self::KEY_TIMEOUT + 1;
}
