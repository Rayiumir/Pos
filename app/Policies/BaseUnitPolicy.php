<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BaseUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class BaseUnitPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BaseUnit');
    }

    public function view(AuthUser $authUser, BaseUnit $baseUnit): bool
    {
        return $authUser->can('View:BaseUnit');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BaseUnit');
    }

    public function update(AuthUser $authUser, BaseUnit $baseUnit): bool
    {
        return $authUser->can('Update:BaseUnit');
    }

    public function delete(AuthUser $authUser, BaseUnit $baseUnit): bool
    {
        return $authUser->can('Delete:BaseUnit');
    }

    public function restore(AuthUser $authUser, BaseUnit $baseUnit): bool
    {
        return $authUser->can('Restore:BaseUnit');
    }

    public function forceDelete(AuthUser $authUser, BaseUnit $baseUnit): bool
    {
        return $authUser->can('ForceDelete:BaseUnit');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BaseUnit');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BaseUnit');
    }

    public function replicate(AuthUser $authUser, BaseUnit $baseUnit): bool
    {
        return $authUser->can('Replicate:BaseUnit');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BaseUnit');
    }

}