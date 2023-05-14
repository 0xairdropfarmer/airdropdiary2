<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Todo;
use App\Notifications\TodoDueDateNotification;
class SendTodoDueDateNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:send-due-date-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send due date notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $todos = Todo::where('due_date', '>=', now()->toDateString())->whereNot('status', 'done')->get();

        foreach ($todos as $todo) {
            $user = $todo->user; // Assuming there is a user associated with each todo
            $user->notify(new TodoDueDateNotification($todo));
        }
        $this->info('Due date notifications sent successfully.');
    }
}
