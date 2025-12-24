<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Kategori;

class Menu extends Model
{
    use SoftDeletes;

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

    public function deleteMenu()
    {
        return $this->delete();
    }
}

