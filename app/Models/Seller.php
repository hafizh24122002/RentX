<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user'];

    // user relation
    public function user() {
        return $this->belongsTo(User::class);
    }

    // property relation
    public function property() {
        return $this->hasMany(Property::class);
    }

    // order relation
    public function order() {
        return $this->hasMany(Order::class);
    }
}
