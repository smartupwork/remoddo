<?php


namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class HeaderNotificationComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $notifications=collect();
        $unread_notifications_count=0;
        if (auth()->check()){
            $notifications=auth()->user()
                ->receiverNotifcations()
                ->where('is_read',false)
                ->orderByDesc('id')
                ->limit(3)->get();
            $unread_notifications_count=auth()->user()
                ->receiverNotifcations()
                ->where('is_read',false)
            ->count();
        }
        $view->with('notifications',$notifications)
            ->with('unread_notifications_count',$unread_notifications_count);
    }
}
