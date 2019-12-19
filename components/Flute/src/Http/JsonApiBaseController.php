<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Http;

use Orzford\Limoncello\Flute\Contracts\Http\Query\RouteIndexInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @package App
 */
abstract class JsonApiBaseController extends \Limoncello\Flute\Http\JsonApiBaseController
{
    /**
     * @inheritDoc
     */
    public static function update(array $routeParams,
                                  ContainerInterface $container,
                                  ServerRequestInterface $request): ResponseInterface
    {
        /** @var RouteIndexInterface $routeIndex */
        $routeIndex = $container->get(RouteIndexInterface::class);
        $routeIndex->setIndex($routeParams[static::ROUTE_KEY_INDEX]);

        return parent::update($routeParams, $container, $request);
    }
}
