<?php

namespace App\Models;

use App\Utils\Filters\FilterBuilder;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class self
 * @package App\Models
 * @property int product_id
 * @property int lender_id
 * @property int renter_id
 * @property int rent_id
 * @property string payment_intent
 * @property float total_price
 * @property float deposit_price
 * @property float original_price
 * @property string status
 * @property string start_date
 * @property string exp_date
 */
class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'orders';

    protected $appends = [
        'date_range_picker',
        'is_expired',
        'total_price_without_fee',
        'late_dispatch_fee',
        'payed_price'
    ];

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     * @return self
     */
    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getLenderId(): int
    {
        return $this->lender_id;
    }

    /**
     * @param int $lender_id
     * @return self
     */
    public function setLenderId(int $lender_id): self
    {
        $this->lender_id = $lender_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getRenterId(): int
    {
        return $this->renter_id;
    }

    /**
     * @param int $renter_id
     * @return self
     */
    public function setRenterId(int $renter_id): self
    {
        $this->renter_id = $renter_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getRentId(): int
    {
        return $this->rent_id;
    }

    /**
     * @param int $rent_id
     * @return self
     */
    public function setRentId(int $rent_id): self
    {
        $this->rent_id = $rent_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentIntent(): string
    {
        return $this->payment_intent;
    }

    /**
     * @param string $payment_intent
     * @return self
     */
    public function setPaymentIntent(string $payment_intent): self
    {
        $this->payment_intent = $payment_intent;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->start_date;
    }

    /**
     * @param string $start_date
     * @return self
     */
    public function setStartDate(string $start_date): self
    {
        $this->start_date = $start_date;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): int
    {
        return $this->total_price;
    }

    /**
     * @param float $total_price
     * @return self
     */
    public function setTotalPrice(float $total_price): self
    {
        $this->total_price = $total_price;
        return $this;
    }


    /**
     * @return float
     */
    public function getDepositPrice(): int
    {
        return $this->deposit_price;
    }

    /**
     * @param float $deposit_price
     * @return self
     */
    public function setDepositPrice(float $deposit_price): self
    {
        $this->deposit_price = $deposit_price;
        return $this;
    }

    /**
     * @return float
     */
    public function getOriginalPrice(): int
    {
        return $this->original_price;
    }

    /**
     * @param float $original_price
     * @return self
     */
    public function setOriginalPrice(float $original_price): self
    {
        $this->original_price = $original_price;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpDate(): string
    {
        return $this->exp_date;
    }

    /**
     * @param string $exp_date
     * @return self
     */
    public function setExpDate(string $exp_date): self
    {
        $this->exp_date = $exp_date;
        return $this;
    }


    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withoutGlobalScopes();
    }

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class,'order_id');
    }


    public function shipping()
    {
        return $this->hasOne(OrderShipping::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notificationable');
    }

    protected function dateRangePicker(): Attribute
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->exp_date)->format('m/d/Y');
        $start = $start->format('m/d/Y');
        return Attribute::make(
            get: fn($value) => "$start - $end"
        );
    }

    protected function totalPriceWithoutFee(): Attribute
    {

        return Attribute::make(
            get: fn($value) => $this->original_price+$this->deposit_price
        );
    }

    protected function lateDispatchFee(): Attribute
    {
        $now=CarbonImmutable::now();
        $diff_date=Carbon::parse($this->exp_date)->diffInDays($now);
        $rent=$this->rent;
        $rent_day=$rent->rent_day;
        return Attribute::make(
            get: fn($value) => $this->is_expired ? round(($this->original_price/$rent_day*late_fee()/100)*$diff_date,1) : 0
        );
    }

    protected function payedPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>$this->renter_id==auth()->id()
                ? $this->total_price_without_fee-$this->late_dispatch_fee
                : $this->total_price_without_fee+$this->late_dispatch_fee
        );
    }

    protected function isExpired(): Attribute
    {
        $now=CarbonImmutable::now();
        $is_expired=Carbon::parse($this->exp_date)->lt($now);

        return Attribute::make(
            get: fn($value) => $is_expired
        );
    }


    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utils\Filters\OrderFilter';
        $filter = new FilterBuilder($query, $filters, $namespace);
        return $filter->apply();
    }

}
