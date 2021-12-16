<?php

namespace App\Providers;

use App\Models\Person;
use App\Models\PersonPet;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\User;
use App\Policies\PersonPetPolicy;
use App\Policies\PersonPolicy;
use App\Policies\PetPolicy;
use App\Policies\PetTypePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Person::class => PersonPolicy::class,
        Pet::class => PetPolicy::class,
        PetType::class => PetTypePolicy::class,
        PersonPet::class => PersonPetPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
