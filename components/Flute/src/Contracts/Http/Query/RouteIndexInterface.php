<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Contracts\Http\Query;

/**
 * @package Orzford\Limoncello\Flute\Contracts\Http\Query
 */
interface RouteIndexInterface
{
    /**
     * @return string
     */
    public function getIndex(): string;

    /**
     * @param string $index
     */
    public function setIndex(string $index): void;
}
