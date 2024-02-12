<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyBudget extends Model {

    use HasFactory;

    protected $table = 'monthly_budgets';

    protected $fillable = [
        'user_id',
        'category_id',
        'Amount',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

}
