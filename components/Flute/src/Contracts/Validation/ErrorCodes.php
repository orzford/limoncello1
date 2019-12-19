<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Contracts\Validation;

/**
 * @package Orzford\Limoncello\Flute\Contracts\Validation
 */
interface ErrorCodes extends \Limoncello\Flute\Contracts\Validation\ErrorCodes
{
    /**
     * @var int
     */
    const IS_UUID = self::FLUTE_LAST + 1;
}
