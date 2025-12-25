<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'user_type',
        'phone',
        'password',
        'email_verified_at',
        'phone_verified_at',
        'preferred_language',
        'newsletter_subscribed',
        'is_active',
        'last_login_at',
        'login_count',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'newsletter_subscribed' => 'boolean',
        'is_active' => 'boolean',
        'login_count' => 'integer',
        'password' => 'hashed',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function defaultAddress(): HasOne
    {
        return $this->hasOne(UserAddress::class)->where('is_default', true);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function activeCart(): HasOne
    {
        return $this->hasOne(Cart::class)->where('status', 'active');
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name)[0];
    }

    public function getWhatsappLinkAttribute(): ?string
    {
        if (!$this->phone) return null;
        $number = preg_replace('/[^0-9]/', '', $this->phone);
        return "https://wa.me/244{$number}";
    }

    // ==========================================
    // MÉTODOS
    // ==========================================

    public function recordLogin(): void
    {
        $this->update([
            'last_login_at' => now(),
            'login_count' => $this->login_count + 1,
        ]);
    }

    public function getOrCreateCart(): Cart
    {
        return $this->activeCart ?? Cart::create([
            'user_id' => $this->id,
            'cart_token' => Cart::generateToken(),
            'status' => 'active',
            'expires_at' => now()->addDays(7),
        ]);
    }

/**
     * Filament: Verifica se pode aceder ao painel
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->canAccessAdmin() && $this->is_active;
    }

    // ==========================================
    // VERIFICAÇÃO DE PERMISSÕES
    // ==========================================

    /**
     * Verifica se é admin
     */
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin';
    }

    /**
     * Verifica se é staff
     */
    public function isStaff(): bool
    {
        return $this->user_type === 'staff';
    }

    /**
     * Verifica se é partner
     */
    public function isPartner(): bool
    {
        return $this->user_type === 'partners';
    }

    /**
     * Verifica se é customer
     */
    public function isCustomer(): bool
    {
        return $this->user_type === 'customer';
    }

    /**
     * Verifica se tem acesso ao admin panel
     */
    public function canAccessAdmin(): bool
    {
        return in_array($this->user_type, ['admin', 'staff']);
    }
}