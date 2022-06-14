<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user'];

    // user relation
    public function user() {
        return $this->belongsTo(User::class);
    }

    // review relation
    public function review() {
        return $this->hasMany(Review::class);
    }

    // order relation
    public function order() {
        return $this->hasMany(Order::class);
    }
}
