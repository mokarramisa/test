<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'shop_id'
    ];

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

    const ROLES = [
        'superAdmin' => User::SUPERADMIN,
        'admin' =>User::ADMIN,
        'user' => User::USER
    ];

    const SUPERADMIN = 'superAdmin';
    const ADMIN = 'admin';
    const USER = 'user';

    public function Orders ()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeRegisterationTime ($query, $adminShopId)
    {
        return $query->where('shop_id', $adminShopId)->orderByDesc('created_at')->get();
    }

    public function scopeOrderCount ($query, $adminShopId)
    {
        return $query->where('shop_id', $adminShopId)->with('orders')->withCount('orders')->orderByDesc('orders_count')->get();
    }

    public function scopeFee ($query, $adminShopId)
    {
        return $query->where('shop_id', $adminShopId)->withSum('orders', 'total_fee')->orderByDesc('orders_sum_total_fee')->get();
    }
}
