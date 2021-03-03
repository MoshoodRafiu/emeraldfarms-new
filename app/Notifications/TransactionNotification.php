<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionNotification extends Notification
{
    use Queueable;

    public $name;

    public $isPending;
    public $isFailed;
    public $isSuccess;

    public $transaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $isPending, $isFailed, $isSuccess, $transaction)
    {
        $this->name = $name;
        $this->isPending = $isPending;
        $this->isFailed = $isFailed;
        $this->isSuccess = $isSuccess;
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->isPending){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your transaction of <b>₦'.number_format($this->transaction->amount,2).'</b> has been saved and pending administrative approval.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!')
                    ->view('emails.new_custom');
        }elseif($this->isFailed){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your transaction of <b>₦'.number_format($this->transaction->amount,2).'</b> failed.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!')
                    ->view('emails.new_custom');
        }elseif($this->isSuccess){
            return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('Your transaction of <b>₦'.number_format($this->transaction->amount,2).'</b> was successful.')
                    ->line('If you have any complaints or queries, please reach out to our support desk.')
                    ->line('Thank you for trusting us!')
                    ->view('emails.new_custom');
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
        if($this->isPending){
            return [
                'body'=>'Your transaction of <b>₦'.number_format($this->transaction->amount,2).'</b> has been saved and pending administrative approval.',
                'icon'=>'<span class="dropdown-item-icon bg-warning text-white"> <i class="fas fa-chart-pie"></i></span>'
            ];
        }elseif($this->isFailed){
            return [
                'body'=>'Your transaction of <b>₦'.number_format($this->transaction->amount,2).'</b> failed.',
                'icon'=>'<span class="dropdown-item-icon bg-danger text-white"> <i class="fas fa-chart-pie"></i></span>'
            ];
        }elseif($this->isSuccess){
            return [
                'body'=>'Your transaction of <b>₦'.number_format($this->transaction->amount,2).'</b> was successful.',
                'icon'=>'<span class="dropdown-item-icon bg-success text-white"> <i class="fas fa-chart-pie"></i></span>'
            ];
        }
    }
}
