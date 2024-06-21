<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use UnexpectedValueException;

class ColorCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value === null) {
            return null;
        }

        if (!is_int($value) || $value < 0 || $value > 0xFFFFFF) {
            throw new UnexpectedValueException;
        }

        return '#' . str_pad(dechex($value), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value === null) {
            return null;
        }

        if (!is_string($value) || !preg_match('/^#[0-9a-fA-F]{6}$/', $value)) {
            throw new UnexpectedValueException;
        }

        return hexdec(substr($value, 1));
    }
}
