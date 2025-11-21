<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Promo extends Model
{
    protected $table = 'promo';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_promo',
        'deskripsi_promo',
        'gambar_promo',
        'status',
        'menu_id', // For backward compatibility
        'kategori_id',
        'min_quantity',
        'discount_type',
        'discount_value',
        'is_discount_active',
        'price_min',
        'price_max',
        'discount_rule',
        'max_discount_uses',
        'valid_until',
        'apply_to_cart_total',
        'is_weekend_only',
        'is_weekday_only',
        'active_days',
        'active_from',
        'active_until',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'price_min' => 'decimal:2',
        'price_max' => 'decimal:2',
        'min_quantity' => 'integer',
        'max_discount_uses' => 'integer',
        'is_discount_active' => 'boolean',
        'status' => 'boolean',
        'apply_to_cart_total' => 'boolean',
        'valid_until' => 'datetime',
        'is_weekend_only' => 'boolean',
        'is_weekday_only' => 'boolean',
        'active_days' => 'array', // JSON array of days
        'active_from' => 'string', // Time only (HH:MM format)
        'active_until' => 'string', // Time only (HH:MM format)
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Many-to-many relationship for multiple menus
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'promo_menu', 'promo_id', 'menu_id');
    }

    /**
     * Check if this discount is applicable for a specific menu and quantity
     */
    public function isApplicable($menuId, $quantity)
    {
        if (!$this->isActiveToday()) {
            return false;
        }

        // Check minimum quantity requirement
        if ($quantity < $this->min_quantity) {
            return false;
        }

        // Advanced rule checking based on menu
        if ($menuId) {
            $menu = Menu::find($menuId);
            if (!$menu) return false;

            switch ($this->discount_rule) {
                case 'single_menu':
                    return $this->menu_id == $menuId;

                case 'multiple_menus':
                    return $this->menus()->where('menu_id', $menuId)->exists();

                case 'category_only':
                    return $this->kategori_id && $menu->kategori_id == $this->kategori_id;

                case 'price_range':
                    return $menu->harga >= $this->price_min && $menu->harga <= $this->price_max;

                case 'all_items':
                default:
                    return true;
            }
        }

        // Legacy check for direct menu_id (backward compatibility)
        if ($this->menu_id && $this->menu_id !== $menuId) {
            return false;
        }

        return true;
    }

    /**
     * Calculate discount amount for given menu price and quantity
     */
    public function calculateDiscount($menuPrice, $quantity, $menuId = null)
    {
        if (!$this->isApplicable($menuId, $quantity)) {
            return 0;
        }

        $totalPrice = $menuPrice * $quantity;

        if ($this->discount_type === 'percentage') {
            $discount = ($totalPrice * $this->discount_value) / 100;
        } else {
            $discount = $this->discount_value;
        }

        // Ensure discount doesn't exceed total price
        return min($discount, $totalPrice);
    }

    /**
     * Calculate final price after discount
     */
    public function calculateFinalPrice($menuPrice, $quantity, $menuId = null)
    {
        $totalPrice = $menuPrice * $quantity;
        $discount = $this->calculateDiscount($menuPrice, $quantity, $menuId);
        return $totalPrice - $discount;
    }

    /**
     * Get discount description for display
     */
    public function getDiscountDescription()
    {
        $menuText = $this->menu ? $this->menu->nama_menu : 'Semua Menu';

        if ($this->discount_type === 'percentage') {
            return "Diskon {$this->discount_value}% untuk {$menuText} (min. {$this->min_quantity} pcs)";
        } else {
            return "Diskon Rp " . number_format($this->discount_value, 0, ',', '.') . " untuk {$menuText} (min. {$this->min_quantity} pcs)";
        }
    }

    /**
     * Check if discount is active today based on day of week and time
     */
    public function isActiveToday()
    {
        // Basic checks
        if (!$this->status || !$this->is_discount_active || $this->discount_value <= 0) {
            return false;
        }

        // Check expiration date
        if ($this->valid_until && now()->isAfter($this->valid_until)) {
            return false;
        }

        // Weekend check: Saturday (6) and Sunday (7) in ISO weekday
        $dayOfWeek = now()->dayOfWeekIso; // 1=Monday, 7=Sunday
        $isWeekend = in_array($dayOfWeek, [6, 7]);
        $isWeekday = in_array($dayOfWeek, [1, 2, 3, 4, 5]);

        // Check weekend/weekday restrictions
        if ($this->is_weekend_only && !$isWeekend) {
            return false;
        }

        if ($this->is_weekday_only && !$isWeekday) {
            return false;
        }

        // Check specific active days (if provided)
        if ($this->active_days && !in_array($dayOfWeek, $this->active_days)) {
            return false;
        }

        // Check time restrictions (if provided)
        $currentTime = now()->format('H:i');

        if ($this->active_from && $currentTime < $this->active_from) {
            return false;
        }

        if ($this->active_until && $currentTime > $this->active_until) {
            return false;
        }

        return true;
    }

    /**
     * Scope for active discounts
     */
    public function scopeActiveDiscounts($query)
    {
        return $query->where('status', true)
                    ->where('is_discount_active', true)
                    ->where('discount_value', '>', 0);
    }

    /**
     * Scope for active discounts that considers today's date and time
     */
    public function scopeActiveDiscountsToday($query)
    {
        return $query->where('status', true)
                    ->where('is_discount_active', true)
                    ->where('discount_value', '>', 0)
                    ->where(function($q) {
                        $q->whereNull('valid_until')
                          ->orWhere('valid_until', '>=', now());
                    });
    }

    /**
     * Get discount display info for frontend
     */
    public static function getDiscountDisplay(Promo $promo)
    {
        $discountText = '';

        switch ($promo->discount_type) {
            case 'percentage':
                $discountText = "{$promo->discount_value}% OFF";
                break;
            case 'fixed':
                $discountText = "Rp " . number_format($promo->discount_value, 0, ',', '.') . " OFF";
                break;
            case 'buy_one_get_one':
                $discountText = "BUY 1 GET 1 FREE";
                break;
            case 'free_shipping':
                $discountText = "FREE SHIPPING";
                break;
        }

        $conditionText = '';
        if ($promo->min_quantity > 1) {
            $conditionText = "Min. {$promo->min_quantity} pcs";
        }

        if ($promo->price_min) {
            $conditionText .= ($conditionText ? ' & ' : '') . "Price: Rp " . number_format($promo->price_min) . "+";
        }

        return [
            'discount_text' => $discountText,
            'condition_text' => $conditionText,
            'rule_description' => self::getRuleDescription($promo),
            'expires_in' => $promo->valid_until ? now()->diffInDays($promo->valid_until) . ' days' : 'No expiration'
        ];
    }

    /**
     * Get human-readable rule description
     */
    private static function getRuleDescription(Promo $promo)
    {
        switch ($promo->discount_rule) {
            case 'single_menu':
                return $promo->menu ? "For {$promo->menu->nama_menu}" : "For specific menu";
            case 'multiple_menus':
                $count = $promo->menus->count();
                return "For {$count} selected menus";
            case 'category_only':
                return $promo->kategori ? "All {$promo->kategori->nama_kategori} items" : "All category items";
            case 'price_range':
                return "Items between Rp " . number_format($promo->price_min) . " - Rp " . number_format($promo->price_max);
            case 'all_items':
            default:
                return "All items in store";
        }
    }

    protected static function booted()
    {
        static::creating(function ($promo) {
            if (!$promo->id) {
                $promo->id = (string) Str::uuid();
            }
        });
        // Hapus gambar saat record dihapus
        static::deleting(function ($promo) {
        if ($promo->gambar) {
            $path = public_path('uploads/promo/' . $promo->gambar_promo);
            if (File::exists($path)) {
                File::delete($path);
            }
            }
        });
    }
}
