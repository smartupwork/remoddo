<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\OrderStatus;
use App\Jobs\QueuedVerifyEmailJob;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @property string email
 * @property string password
 * @property string time_zone
 * @property int role_id
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'time_zone'
    ];

    protected $appends = ['user_balance','rating'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Product::class, 'product_likes');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function localPaymentMethods()
    {
        return $this->hasMany(PaymentMethod::class, 'user_id');
    }

    public function rentals()
    {
        return $this->hasMany(Order::class, 'renter_id');
    }

    public function myWardrobe()
    {
        return $this->myRequests()->where('status', OrderStatus::IN_WARDROBE);
    }

    public function myRequests()
    {
        return $this->hasMany(Order::class, 'lender_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'lender_id')->withoutGlobalScopes();
    }

    public function todos()
    {
        return $this->hasMany(Todo::class, 'lender_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class,'recipient_id');
    }

    public function notReadMessages()
    {
        return $this->messages()->where('is_read',false);
    }

    public function balance()
    {
        return $this->hasOne(UserBalance::class,'user_id');
    }

    public function stripeAccount()
    {
        return $this->hasOne(StripeAccount::class);
    }

    public function rates()
    {
        return $this->hasMany(Rating::class,'user_id');
    }

    public function isAdmin()
    {
        $is_admin = false;
        foreach ($this->roles as $role) {
            if (in_array($role->name, ["admin", "Admin"])) {
                $is_admin = true;
            }
        }
        return $is_admin;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->time_zone;
    }

    /**
     * @param string $time_zone
     * @return self
     */
    public function setTimeZone(string $time_zone): self
    {
        $this->time_zone = $time_zone;
        return $this;
    }



    /**
     * @param $role_name
     * @return bool
     */
    public function checkRole($role_name)
    {
        return $this->roles()->where('role_id', Role::getIdByName($role_name))->exists();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id');
    }

    public function sendEmailVerificationNotification()
    {
        //dispactches the job to the queue passing it this User object
        QueuedVerifyEmailJob::dispatch($this);
    }

    public function receiverNotifcations()
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }

    public function adminlte_image()
    {
        return asset('img/logout.png');
    }

    protected function userBalance(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->balance ? $this->balance->amount : 0,
        );
    }
    protected function rating(): Attribute
    {
        $rating=$this->rates;
        return Attribute::make(
            get: fn($value) =>$rating->sum('rate_value') ?  $rating->sum('rate_value')/$rating->count() : 0,
        );
    }
}
