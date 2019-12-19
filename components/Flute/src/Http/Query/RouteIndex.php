<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Http\Query;

use Limoncello\Container\Traits\HasContainerTrait;
use Orzford\Limoncello\Flute\Contracts\Http\Query\RouteIndexInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * @package App
 */
class RouteIndex implements RouteIndexInterface
{
    use HasContainerTrait;

    /**
     * @var string
     */
    private $index;

    /**
     * @inheritDoc
     */
    public function __construct(PsrContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @inheritDoc
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @inheritDoc
     */
    public function setIndex(string $index): void
    {
        $this->index = $index;
    }
}
