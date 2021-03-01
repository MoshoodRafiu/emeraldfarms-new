<?php

namespace App\Observers;

use App\Wallet;
use App\Notifications\WalletNotification;

class WalletObserver
{
    /**
     * Handle the wallet "created" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function created(Wallet $wallet)
    {
        //
    }

    /**
     * Handle the wallet "updated" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function updated(Wallet $wallet)
    {
        $user = $wallet->user;
        if($wallet->isDirty('total_amount')){
            $old_amount = $wallet->getOriginal('total_amount'); 
            $amount = $wallet->total_amount; 
            $wallet->user->notify(new WalletNotification(explode(' ', $user->name)[0], $old_amount, $amount));
        }
    }

    /**
     * Handle the wallet "deleted" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function deleted(Wallet $wallet)
    {
        //
    }

    /**
     * Handle the wallet "restored" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function restored(Wallet $wallet)
    {
        //
    }

    /**
     * Handle the wallet "force deleted" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function forceDeleted(Wallet $wallet)
    {
        //
    }
}
