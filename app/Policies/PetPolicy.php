<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Pet $pet)
    {
        return $user->currentAccessToken()->id === $pet->token_id;
    }

    public function destroy(User $user, Pet $pet)
    {
        return $user->currentAccessToken()->id === $pet->token_id;
    }

}
