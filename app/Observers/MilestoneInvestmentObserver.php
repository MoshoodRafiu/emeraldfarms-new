<?php

namespace App\Observers;

use App\MilestoneInvestment;
use App\Notifications\MilestoneInvestmentNotification as InvestmentNotification;
use App\User;

class MilestoneInvestmentObserver
{
    /**
     * Handle the milestone investment "created" event.
     *
     * @param  \App\MilestoneInvestment  $milestoneInvestment
     * @return void
     */
    public function created(MilestoneInvestment $milestoneInvestment)
    {
        $user = User::find($investment->user_id);
        if($user){
            $status = $investment->status;
            if($status == 'pending'){
                $this->payRef($user, $investment);
                $user->notify(new InvestmentNotification(explode(' ', $user->name)[0], $investment, false, false, false, false, true));
            }elseif($status == 'active') {
                $user->notify(new InvestmentNotification(explode(' ', $user->name)[0], $investment, false, false, false, true, false));
            }
        }
    }

    /**
     * Handle the milestone investment "updated" event.
     *
     * @param  \App\MilestoneInvestment  $milestoneInvestment
     * @return void
     */
    public function updated(MilestoneInvestment $milestoneInvestment)
    {
        if($investment->isDirty('status')){
            $user = User::find($investment->user_id);
            $status = $investment->status;
            if($status == 'pending'){
                $this->payRef($user, $investment);
                $user->notify(new InvestmentNotification(explode(' ', $user->name)[0], $investment, false, false, false, false, true));
            }elseif($status == 'active') {
                $user->notify(new InvestmentNotification(explode(' ', $user->name)[0], $investment, false, false, false, true, false));
            }elseif($status == 'declined'){
                $user->notify(new InvestmentNotification(explode(' ', $user->name)[0], $investment, true, false, false, false, false));
            }
        }elseif($investment->isDirty('maturity_status')){
            $user = User::find($investment->user_id);
            $status = $investment->status;
            if($status == 'matured'){
                $user->notify(new InvestmentNotification(explode(' ', $user->name)[0], $investment, false, false, true, false, false));
            }
        }elseif($investment->isDirty('paid')){
            $user = User::find($investment->user_id);
            if($investment->paid > 0){
                $user->notify(new InvestmentNotification(explode(' ', $user->name)[0], $investment, false, true, false, false, false));
            }
        }
    }

    /**
     * Handle the milestone investment "deleted" event.
     *
     * @param  \App\MilestoneInvestment  $milestoneInvestment
     * @return void
     */
    public function deleted(MilestoneInvestment $milestoneInvestment)
    {
        //
    }

    /**
     * Handle the milestone investment "restored" event.
     *
     * @param  \App\MilestoneInvestment  $milestoneInvestment
     * @return void
     */
    public function restored(MilestoneInvestment $milestoneInvestment)
    {
        //
    }

    /**
     * Handle the milestone investment "force deleted" event.
     *
     * @param  \App\MilestoneInvestment  $milestoneInvestment
     * @return void
     */
    public function forceDeleted(MilestoneInvestment $milestoneInvestment)
    {
        //
    }
}
