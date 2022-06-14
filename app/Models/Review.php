<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['order', 'property', 'buyer'];

    // order relation
    public function order(){
        return $this->belongsTo(Order::class);
    }

    // property relation
    public function property(){
        return $this->belongsTo(Property::class);
    }

    // buyer relation
    public function buyer() {
        return $this->belongsTo(Buyer::class);
    }
}
