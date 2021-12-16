<?php

namespace App\Policies;

use App\Models\PetType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetTypePolicy
{
    use HandlesAuthorization;

    public function update(User $user, PetType $petType)
    {
        return $user->currentAccessToken()->id === $petType->token_id;
    }

    public function destroy(User $user, PetType $petType)
    {
        return $user->currentAccessToken()->id === $petType->token_id;
    }

}
