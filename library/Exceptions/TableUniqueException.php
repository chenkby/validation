<?php

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class TableUniqueException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}}已经存在了',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}}已经存在了',
        ],
    ];
}
