<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Kategori;

class Menu extends Model
{
    protected $table = 'menu';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_menu',
        'deskripsi_menu',
        'prosedur',
        'harga',
        'stok',
        'gambar_menu',
        'kategori_id',
    ];


    protected static function booted()
    {
        static::creating(function ($menu) {
            if (!$menu->id) {
                $menu->id = (string) Str::uuid();
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Multiple promos relationship (many-to-many via pivot table)
     */
    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'promo_menu', 'menu_id', 'promo_id');
    }

    /**
     * Single promo relationship (direct foreign key)
     */
    public function singlePromo()
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }



    public function deleteMenu()
    {
        return $this->delete();
    }

    /**
     * Get all active promotions applicable to this menu
     */
    public function getActivePromotions()
    {
        return Promo::activeDiscounts()->get()->filter(function($promo) {
            return $this->checkPromotionApplicability($promo);
        });
    }

    /**
     * Check if a promotional is applicable to this menu
     */
    protected function checkPromotionApplicability(Promo $promo)
    {
        switch ($promo->discount_rule) {
            case 'single_menu':
                return $promo->menu_id == $this->id;

            case 'multiple_menus':
                return $promo->menus()->where('menu_id', $this->id)->exists();

            case 'category_only':
                return $promo->kategori_id && $this->kategori_id == $promo->kategori_id;

            case 'price_range':
                return $this->harga >= $promo->price_min && $this->harga <= $promo->price_max;

            case 'all_items':
            default:
                return true;
        }
    }

    /**
     * Get the best applicable promotion (highest discount) for minimum quantity
     */
    public function getBestPromotion($quantity = 1)
    {
        $applicablePromos = $this->getActivePromotions()->filter(function($promo) use ($quantity) {
            return $quantity >= $promo->min_quantity;
        });

        $bestPromo = null;
        $maxDiscount = 0;

        foreach ($applicablePromos as $promo) {
            $discount = $promo->calculateDiscount($this->harga, $quantity);
            if ($discount > $maxDiscount) {
                $maxDiscount = $discount;
                $bestPromo = $promo;
            }
        }

        return $bestPromo;
    }

    /**
     * Calculate final price with discount applied
     */
    public function calculateDiscountedPrice($quantity = 1)
    {
        $promo = $this->getBestPromotion($quantity);

        if (!$promo) {
            return $this->harga * $quantity;
        }

        return $promo->calculateFinalPrice($this->harga, $quantity);
    }

    /**
     * Get discount amount for this menu item
     */
    public function getDiscountAmount($quantity = 1)
    {
        $promo = $this->getBestPromotion($quantity);

        if (!$promo) {
            return 0;
        }

        return $promo->calculateDiscount($this->harga, $quantity);
    }

    /**
     * Get promotion display info for frontend
     */
    public function getPromotionDisplay($quantity = 1)
    {
        $promo = $this->getBestPromotion($quantity);

        if (!$promo) {
            return null;
        }

        return Promo::getDiscountDisplay($promo);
    }

}
