<?php

namespace App\Enum\ManageEnum;

trait EnumToArray
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        try {
            return array_column(self::cases(), 'value');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

}
