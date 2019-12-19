<?php declare (strict_types=1);

namespace Orzford\Limoncello\Tests\Data;

use Mockery;

/**
 * @package App
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
