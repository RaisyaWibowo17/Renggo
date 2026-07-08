<?php

namespace App\Policies;

use App\Models\Umkm;
use App\Models\User;

class UmkmPolicy
{
    public function update(User $user, Umkm $umkm): bool
    {
        return $user->isOwner() && $user->id === $umkm->user_id;
    }

    public function delete(User $user, Umkm $umkm): bool
    {
        return $user->isOwner() && $user->id === $umkm->user_id;
    }

    public function manage(User $user, Umkm $umkm): bool
    {
        return $this->update($user, $umkm);
    }
}
