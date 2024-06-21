<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
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
        'description',
        'icon',
        'main_currency',
        'original_balance',
        'opening_date',
    ];

    /**
     * An account belongs to a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_ulid', 'ulid');
    }

    /**
     * An account belongs to an account group.
     *
     * @return BelongsTo
     */
    public function accountGroup(): BelongsTo
    {
        return $this->belongsTo(AccountGroup::class, 'account_group_ulid', 'ulid');
    }
}
