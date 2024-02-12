<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model {

    protected $table = 'rewards';

    protected $fillable = [
        'user_id',
        'description',
        'points',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

}
