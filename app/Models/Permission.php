<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @use HasFactory<PermissionFactory>
 */
class Permission extends SpatiePermission
{
    use HasFactory, HasUlids;
    protected $primaryKey = 'ulid';
    protected $keyType = 'string';
}
