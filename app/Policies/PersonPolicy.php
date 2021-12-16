<?php

namespace App\Policies;

use App\Models\Person;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Person $person)
    {
        return $user->currentAccessToken()->id === $person->token_id;
    }

    public function destroy(User $user, Person $person)
    {
        return $user->currentAccessToken()->id === $person->token_id;
    }

}
