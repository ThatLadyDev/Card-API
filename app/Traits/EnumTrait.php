<?php

namespace App\Traits;

trait EnumTrait
{
    public static function toArray(string $type = 'all'): array
    {
        return array_map(
            fn (self $enum) => $type === 'all' ?
                [$enum->name => $enum->value] : ($type === 'name' ? $enum->name : $enum->value),
            self::cases()
        );
    }
}
