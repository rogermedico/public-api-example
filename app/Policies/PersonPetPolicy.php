<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPetPolicy
{
    use HandlesAuthorization;

    public function update(User $user, PersonPet $personPet)
    {
        return $user->currentAccessToken()->id === $personPet->token_id;
    }

    public function destroy(User $user, PersonPet $personPet)
    {
        return $user->currentAccessToken()->id === $personPet->token_id;
    }

}
