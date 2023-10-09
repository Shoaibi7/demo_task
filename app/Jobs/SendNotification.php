<?php

namespace App\Jobs;

use App\Notifications\NotificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notifiable;
    protected $notification;
    /**
     * Create a new job instance.
     */
    public function __construct($notifiable, NotificationEmail $notification)
    {
        $this->notifiable = $notifiable;
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->notifiable->notify($this->notification);
    }
}
