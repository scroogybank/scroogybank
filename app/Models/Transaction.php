<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;

class Transaction extends Model
{
    use HasFactory, HasUlids;

    protected $primaryKey = 'ulid';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'amount',
        'note',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => MoneyCast::class,
            'status' => TransactionStatus::class,
        ];
    }

    /**
     * Helper function to determine if a transaction belongs to a collection.
     *
     * @return Attribute
     */
    public function isCollection(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Arr::get($attributes, 'collection_ulid') !== null,
        );
    }

    /**
     * Helper function to determine if a transaction is a transfer.
     *
     * @return Attribute
     */
    public function isTransfer(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Arr::get($attributes, 'transfer_transaction_ulid') !== null,
        );
    }

    /**
     * A transaction belongs to a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_ulid', 'ulid');
    }

    /**
     * A transaction belongs to an account.
     *
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_ulid', 'ulid');
    }

    /**
     * A transaction belongs to a category.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_ulid', 'ulid');
    }

    /**
     * A transaction may have an associated store.
     *
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_ulid', 'ulid');
    }

    /**
     * A transfer has an associated transaction that is the source of the transfer.
     *
     * @return HasOne
     */
    public function transferFrom(): HasOne
    {
        return $this->hasOne(self::class, 'transfer_from_ulid', 'ulid');
    }

    /**
     * A transaction may belong to many labels.
     *
     * @return BelongsToMany
     */
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'label_transaction', 'transaction_ulid', 'label_ulid')
            ->withTimestamps();
    }

    /**
     * Retrieve all transactions that are part of this collection.
     *
     * @return HasMany
     */
    public function collectionTransactions(): HasMany
    {
        return $this->hasMany(self::class, 'collection_ulid', 'ulid')
            ->where('ulid', '!=', $this->ulid);
    }
}
