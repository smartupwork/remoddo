<?php

namespace App\Http\Controllers\Main\Profile;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // echo 'here';
        // exit;
       $notifications= auth()->user()
            ->receiverNotifcations()
            ->where('is_read',false)
           ->orderByDesc('id')
            ->paginate(10);


       return view('main.pages.profile.notifications.index',compact('notifications'));
    }

    public function isRead(Notification $notification)
    {
        $notification->is_read=true;
        $notification->save();
        return redirect()->to($notification->url);
    }
}
