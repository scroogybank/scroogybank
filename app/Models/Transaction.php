<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasUlids;

    protected $primaryKey = 'ulid';
    protected $keyType = 'string';

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
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
