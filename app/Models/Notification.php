<?php

namespace App\Models;

use App\Enums\NotificationType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts=[
        'read'=>'bool'
    ];

    protected $appends=[
        'title',
        'image'
    ];

    public function notificationable()
    {
        return $this->morphTo();
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }

    protected function title(): Attribute
    {
        $type=NotificationType::converted_data()[$this->type];
        return new Attribute(
            get: fn($value) => $type
        );
    }


    protected function image(): Attribute
    {
        $notification_images=[
            NotificationType::LATE_DISPATCH=>'main/img/icons/icon-warning.svg',
            NotificationType::SEND_BACK=>'main/img/icons/icon-clock-time.svg',
            NotificationType::SEND_BACK_NOTIFY=>'main/img/icons/icon-delivery-truck-fast.svg',
            NotificationType::RETURNED=>'main/img/icons/icon-delivery-truck-fast.svg',
            NotificationType::PRODUCT_REQUESTED=>'main/img/icons/icon-delivery-truck-fast.svg',
        ];
        return new Attribute(
            get: fn($value) => asset($notification_images[$this->type])
        );
    }
}
