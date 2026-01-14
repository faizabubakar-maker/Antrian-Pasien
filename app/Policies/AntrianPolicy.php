<?php

namespace App\Policies;

use App\Models\Antrian;
use App\Models\User;

class AntrianPolicy
{
    /**
     * User boleh cancel antrian
     */
    public function cancel(User $user, Antrian $antrian): bool
    {
        return $user->id === $antrian->user_id
            && $antrian->status === 'WAITING';
    }
}