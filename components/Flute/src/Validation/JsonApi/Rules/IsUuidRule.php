<?php declare (strict_types=1);

namespace Orzford\Limoncello\Flute\Validation\JsonApi\Rules;

use Limoncello\Validation\Contracts\Execution\ContextInterface;
use Limoncello\Validation\Rules\ExecuteRule;
use Orzford\Limoncello\Flute\Contracts\Validation\ErrorCodes;
use Orzford\Limoncello\Flute\L10n\Messages;
use Ramsey\Uuid\Validator\ValidatorInterface as UuidValidatorInterface;

/**
 * @package App
 */
final class IsUuidRule extends ExecuteRule
{
    /**
     * @inheritDoc
     */
    public static function execute($value, ContextInterface $context): array
    {
        /** @var UuidValidatorInterface $uuidValidator */
        $uuidValidator = $context->getContainer()->get(UuidValidatorInterface::class);

        return $uuidValidator->validate($value) === true ?
            static::createSuccessReply($value) :
            static::createErrorReply(
                $context,
                $value,
                ErrorCodes::IS_UUID,
                Messages::IS_UUID,
                []
            );
    }
}
