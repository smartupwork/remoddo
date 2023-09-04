<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('message-channel.{order_id}', function ($user,$order_id) {
    return \App\Models\Order::where('id',$order_id)->where(function ($query) use($user){
        $query->orWhere('lender_id',$user->id)->orWhere('renter_id',$user->id);
    })->exists();
});

Broadcast::channel('channel-not-read-message.{id}', function ($user, $id) {
    return $user->id ==$id;
});
Broadcast::channel('notification.{receiver_id}', function ($user, $receiver_id) {
    return $user->id==$receiver_id;
});
