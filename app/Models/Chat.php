<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['last_message','not_read_message_count'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected function lastMessage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->messages()
            ->latest()->first()
        );
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    protected function notReadMessageCount(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->messages()->where('is_read',false)->count()
        );
    }

}
