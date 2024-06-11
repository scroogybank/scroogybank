<?php

namespace App\Casts;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use Arr;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use UnexpectedValueException;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $amount = Arr::get($attributes, 'amount');
        $currency = Arr::get($attributes, 'currency');

        if (!is_int($amount) || !is_string($currency) || !key_exists($currency, Currency::getCurrencies())) {
            throw new UnexpectedValueException;
        }

        return new Money($amount, new Currency($currency));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (!$value instanceof Money) {
            throw new UnexpectedValueException;
        }

        return [
            'amount' => $value->getAmount(),
            'currency' => $value->getCurrency()->getCurrency(),
        ];
    }
}
