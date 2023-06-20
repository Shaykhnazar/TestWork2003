<?php

namespace App\Models;

use App\Models\Traits\HasIncludeWithTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasIncludeWithTrait;

    public const ADMIN = 'admin';

    public const EDITOR = 'editor';

    public const VIEWER = 'viewer';

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function syncPermissions(array $permissionIds): void
    {
        $this->permissions()->sync($permissionIds);
    }

}
