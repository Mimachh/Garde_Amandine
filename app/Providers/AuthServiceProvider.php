<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Animal;
use App\Models\Annonce;
use App\Models\Proposal;
use App\Policies\AnimalPolicy;
use App\Policies\AnnoncePolicy;
use App\Policies\ProposalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Annonce::class => AnnoncePolicy::class,
        Proposal::class => ProposalPolicy::class,
        Animal::class => AnimalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
