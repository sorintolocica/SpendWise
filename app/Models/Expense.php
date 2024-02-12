<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

    protected $table = 'Expenses';

    protected $fillable = [
        'user_id',
        'category_id',
        'Amount',
        'Date',
        'Description',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

}
