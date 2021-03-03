<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaidMilestoneNotification extends Notification
{
    use Queueable;

    public $name;
    public $milestone;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $milestone)
    {
        $this->name = $name;
        $this->milestone = $milestone;
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
        return (new MailMessage)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line('You just got a milestone payment of <b>₦'.number_format($this->milestone->amount,2).'</b> for your investment with <b>'.ucwords($this->milestone->investment->farm->title).'</b>')
                    ->line('Thank you for trusting us!')
                    ->view('emails.new_custom');
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
            'body'=>'You just got a milestone payment of <b>₦'.number_format($this->milestone->amount,2).'</b> for your investment with <b>'.ucwords($this->milestone->investment->farm->title).'</b>',
            'icon'=>'<span class="dropdown-item-icon bg-success text-white"> <i class="fab fa-amazon-pay"></i><span>'
        ];
    }
}
