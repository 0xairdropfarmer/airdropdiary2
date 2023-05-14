<?php

namespace App\Notifications;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TodoDueDateNotification extends Notification
{
    use Queueable;
    // protected $todo;
    /**
     * Create a new notification instance.
     */
    public function __construct(public Todo $todo)
    {
        // $this->todo = $todo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // dd($this);
        return (new MailMessage)
        ->subject('Todo Task Due Date Reminder')
        ->line('This is a reminder that your todo task is due soon.')
        ->line('Task: '.$this->todo->task->title)
        ->line('Due Date: '.$this->todo->due_date)
        ->action('View Task', route('frontend.tasks.show', $this->todo->task->id))
        ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
