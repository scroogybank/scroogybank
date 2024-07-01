<?php

namespace App\Http\Requests;

use Akaunting\Money\Currency;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'transactions' => [
                'required',
                'array',
                'min:1',
                // TODO: add a rule to check that kind of transactions we are performing (e.g. transfer, collection or normal)
            ],

            'transactions.*.name' => 'required|string|max:255',
            'transactions.*.amount' => 'required|integer',
            'transactions.*.currency' => ['required', 'string', 'size:3', Rule::in(Currency::getCurrencies())],
            'transactions.*.note' => 'nullable|string',
            'transactions.*.registered_at' => 'required|date',
            'transactions.*.status' => 'nullable|string|in:cleared,reconciled',
            'transactions.*.external_id' => 'nullable|string|max:255|unique:App\Model\Transaction,external_id',

            'transactions.*.account_ulid' => 'required|ulid|exists:App\Model\Account,ulid',
            'transactions.*.category_ulid' => 'required|ulid|exists:App\Model\Category,ulid',
        ];
    }
}
