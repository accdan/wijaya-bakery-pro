<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pesanan extends Model
{
    use HasFactory, SoftDeletes;

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
}

