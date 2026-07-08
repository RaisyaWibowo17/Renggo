<?php

namespace App\Policies;

use App\Models\Promo;
use App\Models\User;

class PromoPolicy
{
    public function update(User $user, Promo $promo): bool
    {
        return $user->isOwner() && $user->id === $promo->umkm->user_id;
    }

    public function delete(User $user, Promo $promo): bool
    {
        return $user->isOwner() && $user->id === $promo->umkm->user_id;
    }
}
