<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HeelType extends Model
{
    protected $table = 'heel_types';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'height_range',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_heel_types');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}