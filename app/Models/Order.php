<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['buyer', 'seller', 'property'];

    // review relation
    public function review(){
        return $this->hasOne(Review::class);
    }

    // buyer relation
    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }

    // seller relation
    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    // property relation
    public function property() {
        return $this->belongsTo(Property::class);
    }
}
