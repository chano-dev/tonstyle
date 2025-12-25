<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'recipient_phone',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'province',
        'postal_code',
        'country',
        'landmark',
        'is_default',
        'is_active',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getFullAddressAttribute(): string
    {
        $parts = [];
        if ($this->street) {
            $address = $this->street;
            if ($this->number) $address .= ', ' . $this->number;
            $parts[] = $address;
        }
        if ($this->neighborhood) $parts[] = $this->neighborhood;
        if ($this->city) $parts[] = $this->city;
        return implode(' - ', $parts);
    }

    // ==========================================
    // MÉTODOS
    // ==========================================

    public function setAsDefault(): void
    {
        $this->user->addresses()->where('id', '!=', $this->id)->update(['is_default' => false]);
        $this->update(['is_default' => true]);
    }
}