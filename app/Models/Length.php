<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Length extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_lengths');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}