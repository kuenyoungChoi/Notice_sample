<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class noticeSlackNotification extends Notification
{
    use Queueable;

    public array $notice = [];
    public int $to = 0;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $notice, $to = 0)
    {
        $this->notice = $notice;
        $this->to = $to;
    }

    public function toSlack($notifiable)
    {
        if (empty($this->notice)) return false;
        $outs = '';
        foreach ($this->notice as $n) $outs = $outs . $n . PHP_EOL . PHP_EOL;
        $to = 'clickup-task';
        return (new SlackMessage)
                    ->from(env('APP_URL'))
                    ->to($to)
                    ->content($outs);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
