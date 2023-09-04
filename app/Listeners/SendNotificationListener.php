<?php

namespace App\Listeners;

use App\Events\SendNotificationEvent;
use App\Events\SocketNotificationEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\SendNotificationEvent $event
     * @return void
     */
    public function handle(SendNotificationEvent $event)
    {
        
        $notification = $event->model->notifications()->create([
            'receiver_id' => $event->receiver_id,
            'context' => $event->context,
            'type' => $event->type,
            'url' => $event->url,
            'created_at' => now()
        ]);

        $user = User::find($notification->receiver_id);

        $unread_notifications_count = $user->receiverNotifcations()
            ->where('is_read', false)
            ->count();
        event(new SocketNotificationEvent(
            $notification->context,
            $notification->image,
            $notification->title,
            $notification->receiver_id,
            $unread_notifications_count,
            $notification->created_at->diffForHumans()
        ));
    }
}
