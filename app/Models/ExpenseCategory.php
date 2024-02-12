<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model {

    use SoftDeletes;

    protected $table = 'expense_categories';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'Name',
    ];

    public function expenses() {
        return $this->hasMany(Expense::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function monthlyBudget() {
        return $this->belongsTo(MonthlyBudget::class);
    }

}
