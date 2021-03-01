<?php

namespace App\Observers;

use App\PaidMilestone;
use App\Notifications\PaidMilestoneNotification;

class PaidMilestoneObserver
{
    /**
     * Handle the paid milestone "created" event.
     *
     * @param  \App\PaidMilestone  $paidMilestone
     * @return void
     */
    public function created(PaidMilestone $paidMilestone)
    {
        $user = $paidMilestone->investment->user;
        $user->notify(new PaidMilestoneNotification(explode(' ', $user->name)[0], $paidMilestone));
    }

    /**
     * Handle the paid milestone "updated" event.
     *
     * @param  \App\PaidMilestone  $paidMilestone
     * @return void
     */
    public function updated(PaidMilestone $paidMilestone)
    {
        //
    }

    /**
     * Handle the paid milestone "deleted" event.
     *
     * @param  \App\PaidMilestone  $paidMilestone
     * @return void
     */
    public function deleted(PaidMilestone $paidMilestone)
    {
        //
    }

    /**
     * Handle the paid milestone "restored" event.
     *
     * @param  \App\PaidMilestone  $paidMilestone
     * @return void
     */
    public function restored(PaidMilestone $paidMilestone)
    {
        //
    }

    /**
     * Handle the paid milestone "force deleted" event.
     *
     * @param  \App\PaidMilestone  $paidMilestone
     * @return void
     */
    public function forceDeleted(PaidMilestone $paidMilestone)
    {
        //
    }
}
