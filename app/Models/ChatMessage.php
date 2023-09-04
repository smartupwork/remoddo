<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['hour','opposite_side_user'];

    protected $casts=[
        'is_read'=>'bool'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipient()
    {
        return $this->belongsTo(User::class,'recipient_id');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    public function disputes()
    {
        return $this->belongsToMany(DisputeCategory::class, 'conversation_dispute_categories', 'chat_message_id', 'dispute_category_id')
            ->withPivot('support_agent_id','full_name_agent');

    }

    protected function hour(): Attribute
    {
        $time_zone=auth()->check() ? auth()->user()->time_zone : config('app.timezone');
        return Attribute::make(
            get: fn($value) => $this->created_at->setTimezone($time_zone)->format('g:i A'),
        );
    }
    protected function oppositeSideUser(): Attribute
    {
        $user=auth()->user()->id===$this->user->id ? $this->recipient : $this->user ;
        return Attribute::make(
            get: fn($value) => $user,
        );
    }

}
