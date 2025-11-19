<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pesanan extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pesanan';

    protected $fillable = [
        'nama_pemesan',
        'no_hp',
        'menu_id',
        'harga_satuan',
        'jumlah',
        'total_harga',
        'discount_amount',
        'discount_type',
        'promo_id',
        'final_price',
        'catatan',
    ];



    protected static function booted()
    {
        static::creating(function ($pesanan) {
            if (!$pesanan->id) {
                $pesanan->id = (string) Str::uuid();
            }
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }

    /**
     * Calculate applicable discount for this order item at the time it was placed
     * Note: Since discount info isn't directly stored with each order,
     * this shows what discount would currently apply to this item
     */
    public function calculateDiscountAtOrderTime()
    {
        if (!$this->menu) {
            return 0;
        }

        // Get all currently active discounts
        // This approximates what was likely active when the order was placed
        $activeDiscounts = \App\Models\Promo::where('status', true)
            ->where('is_discount_active', true)
            ->get();

        $discount = 0;
        foreach ($activeDiscounts as $promo) {
            if ($promo->isApplicable($this->menu_id, $this->jumlah)) {
                $itemDiscount = $promo->calculateDiscount($this->harga_satuan, $this->jumlah);
                if ($itemDiscount > $discount) {
                    $discount = $itemDiscount; // Take the largest discount
                }
            }
        }

        return $discount;
    }

    /**
     * Get discount description that would apply
     */
    public function getApplicableDiscount()
    {
        if (!$this->menu) {
            return null;
        }

        $activeDiscounts = \App\Models\Promo::where('status', true)
            ->where('is_discount_active', true)
            ->get();

        foreach ($activeDiscounts as $promo) {
            if ($promo->isApplicable($this->menu_id, $this->jumlah)) {
                return $promo;
            }
        }

        return null;
    }
}
