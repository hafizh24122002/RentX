<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['seller'];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%')->orWhere('address', 'like', '%' . $search . '%')->orWhere('province', 'like', '%' . $search . '%')->orWhere('city', 'like', '%' . $search . '%')->orWhere('district', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['type'] ?? false, function($query, $type) {
            return $query->where(function($query) use ($type) {
                $query->where('property_type', $type);
            });
        });

        $query->when($filters['for'] ?? false, function($query, $for) {
            return $query->where(function($query) use ($for) {
                $query->where('rent_for', $for);
            });
        });

        $query->when($filters['city'] ?? false, function($query, $city) {
            return $query->where(function($query) use ($city) {
                $query->where('city', $city);
            });
        });
    }

    // seller relation
    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    // review relation
    public function review() {
        return $this->hasMany(Review::class);
    }

    // order relation
    public function order() {
        return $this->hasMany(Order::class);
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
