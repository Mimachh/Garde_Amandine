<?php

namespace App\Policies;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Proposal $proposal)
    {
        if($user->id === $proposal->user_id) {
            return true;
        } elseif($user->id === $proposal->annonce->user->id) {
            return true;
        }
        elseif($user->role->id === 1) {
            return true;
        }
    }

    public function buttonForAnswer(User $user, Proposal $proposal)
    {
        return $user->id === $proposal->annonce->user->id;
    }

    public function waitingForAnswer(User $user, Proposal $proposal)
    {
        return $user->id === $proposal->user_id;
    }

    public function paid(User $user, Proposal $proposal)
    {
        if($user->id === $proposal->user_id)
        {
            if($proposal->validated === 1)
            {
                return true;
            }
        }
        else 
        {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Proposal $proposal)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Proposal $proposal)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Proposal $proposal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Proposal $proposal)
    {
        //
    }
}
