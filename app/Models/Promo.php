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
        'menu_id',
        'min_quantity',
        'discount_type',
        'discount_value',
        'is_discount_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_quantity' => 'integer',
        'is_discount_active' => 'boolean',
        'status' => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    /**
     * Check if this discount is applicable for a specific menu and quantity
     */
    public function isApplicable($menuId, $quantity)
    {
        if (!$this->is_discount_active || !$this->status) {
            return false;
        }

        // If specific menu is set, check if it matches
        if ($this->menu_id && $this->menu_id !== $menuId) {
            return false;
        }

        // Check minimum quantity requirement
        if ($quantity < $this->min_quantity) {
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
     * Scope for active discounts
     */
    public function scopeActiveDiscounts($query)
    {
        return $query->where('status', true)
                    ->where('is_discount_active', true)
                    ->where('discount_value', '>', 0);
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

    public static function createPromo($data)
    {
        return self::create([
            'nama_promo'     => $data['nama_promo'],
            'deskrpsi_promo'      => $data['deskrpsi_promo'],
            'gambar_promo'   => $data['gambar_promo'] ?? null,
            'status'         => $data['status'] ?? true,
        ]);
    }

    public function updatePromo($data)
    {
        return $this->update([
            'nama_promo'     => $data['nama_promo'] ?? $this->nama_promo,
            'deskrpsi_promo' => $data['deskrpsi_promo'] ?? $this->deskrpsi_promo,
            'gambar_promo'   => $data['gambar_promo'] ?? $this->gambar_promo,
            'status'         => $data['status'] ?? $this->status,
        ]);
    }

    public function deletePromo()
    {
        return $this->delete();
    }
}
