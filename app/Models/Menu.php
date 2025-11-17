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

    public static function createMenu($data)
    {
        return self::create([
            'nama_menu'      => $data['nama_menu'],
            'deskripsi_menu' => $data['deskripsi_menu'],
            'prosedur'       => $data['prosedur'],
            'harga'=> $data['harga'],
            'stok'=> $data['stok'],
            'gambar_menu'    => $data['gambar_menu'] ?? null,
            'kategori_id'    => $data['kategori_id'],
        ]);
    }

    public function updateMenu($data)
    {
        return $this->update([
            'nama_menu'      => $data['nama_menu'] ?? $this->nama_menu,
            'deskripsi_menu' => $data['deskripsi_menu'] ?? $this->deskripsi_menu,
            'prosedur'       => $data['prosedur'] ?? $this->prosedur,
            'harga'=> $data['harga'] ?? $this->harga,
            'stok'=> $data['stok'] ?? $this->stok,
            'gambar_menu'    => $data['gambar_menu'] ?? $this->gambar_menu,
            'kategori_id'    => $data['kategori_id'] ?? $this->kategori_id,
        ]);
    }

    public function deleteMenu()
    {
        return $this->delete();
    }

}
