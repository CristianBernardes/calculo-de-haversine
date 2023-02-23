<?php

namespace App\Http\Requests\Traits;

/**
 *
 */
trait AuxiliaryValidationsTrait
{
    /**
     * @param $value
     * @param $formats
     * @return bool
     */
    public function datetimeFormat($value, $formats): bool
    {
        foreach ($formats as $format) {

            $parsed = date_parse_from_format($format, $value);

            if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {

                return true;
            }
        }

        return false;
    }
}
