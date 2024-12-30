<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @use HasFactory<RoleFactory>
 */
class Role extends SpatieRole
{
    use HasFactory, HasUlids;
    protected $primaryKey = 'ulid';
    protected $keyType = 'string';
}
