<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'plan_id',
        'plan_name',
        'plan_price',
        'plan_description',
        'credits_per_month',
        'start_date',
        'end_date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            $plan = Plan::find($subscription->plan_id);

            if ($plan) {
                $subscription->plan_name = $plan->plan_name;
                $subscription->plan_price = $plan->plan_price;
                $subscription->plan_description = $plan->plan_description;
                $subscription->credits_per_month = $plan->credits_per_month;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function isActive()
    {
        return $this->end_date > now();
    }

    public function isExpired()
    {
        return $this->end_date < now();
    }
}
