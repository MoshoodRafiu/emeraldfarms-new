<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MilestoneInvestmentNotification extends Notification
{
    use Queueable;

    public $name;
    public $inv;

    public $isDeclined;
    public $isPaid;
    public $isMatured;
    public $isActive;
    public $isPending;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $inv, $isDeclined, $isPaid, $isMatured, $isActive, $isPending)
    {
        $this->name = $name;
        $this->inv = $inv;
        $this->isDeclined = $isDeclined;
        $this->isPaid = $isPaid;
        $this->isMatured = $isMatured;
        $this->isActive = $isActive;
        $this->isPending = $isPending;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->isDeclined){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your <b>₦'.number_format($this->inv->amount_invested2).'</b> purchase of <b>'.$this->inv->units.' units</b> with <b>'.ucwords($this->inv->farm->title).'</b> farm has been declined.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!');
        }elseif($this->isPaid){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your <b>₦'.number_format($this->inv->amount_invested2).'</b> purchase of <b>'.$this->inv->units.' units</b> with <b>'.ucwords($this->inv->farm->title).'</b> farm has been paid to your wallet.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!');
        }elseif($this->isMatured){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your <b>₦'.number_format($this->inv->amount_invested2).'</b> purchase of <b>'.$this->inv->units.' units</b> with <b>'.ucwords($this->inv->farm->title).'</b> farm has matured for payouts.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!');
        }elseif($this->isActive){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your <b>₦'.number_format($this->inv->amount_invested2).'</b> purchase of <b>'.$this->inv->units.' units</b> with <b>'.ucwords($this->inv->farm->title).'</b> farm is now active.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!');
        }elseif($this->isPending){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your <b>₦'.number_format($this->inv->amount_invested2).'</b> purchase of <b>'.$this->inv->units.' units</b> with <b>'.ucwords($this->inv->farm->title).'</b> farm is successful.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!');
        }
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
