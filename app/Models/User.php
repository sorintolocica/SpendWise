<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

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
        'password' => 'hashed',
    ];

    public function expenses() {
        return $this->hasMany(Expense::class);
    }

    public function categories() {
        return $this->hasMany(ExpenseCategory::class);
    }

    public function monthlyBudget() {
        return $this->hasMany(MonthlyBudget::class);
    }

    public function rewards() {
        return $this->hasMany(Reward::class);
    }

    public function rewardThisMonth() {
        $today = Carbon::now();
        $start = $today->startOfMonth()->format('Y-m-d H:i:s');
        $end = $today->endOfMonth()->format('Y-m-d H:i:s');

        return $this->rewards()->whereBetween('created_at', [$start, $end]);
    }

}
