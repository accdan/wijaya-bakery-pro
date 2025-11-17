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

    public static function createPesanan(array $data): Pesanan
    {
        $menu = Menu::find($data['menu_id']);
        if (!$menu) {
            throw new \Exception('Menu tidak ditemukan');
        }

        $pesanan = new self();
        $pesanan->nama_pemesan = $data['nama_pemesan'];
        $pesanan->no_hp = $data['no_hp'];
        $pesanan->menu_id = $data['menu_id'];
        $pesanan->harga_satuan = $menu->harga;
        $pesanan->jumlah = $data['jumlah'];
        $pesanan->total_harga = $pesanan->harga_satuan * $pesanan->jumlah;
        $pesanan->catatan = $data['catatan'] ?? null;
        $pesanan->save();

        return $pesanan;
    }

    public static function updatePesanan(string $id, array $data): bool
    {
        $pesanan = self::find($id);
        if (!$pesanan) {
            return false;
        }

        if (isset($data['menu_id'])) {
            $menu = Menu::find($data['menu_id']);
            if ($menu) {
                $pesanan->menu_id = $data['menu_id'];
                $pesanan->harga_satuan = $menu->harga;
            }
        }

        $fields = ['nama_pemesan', 'no_hp', 'jumlah', 'catatan'];
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $pesanan->$field = $data[$field];
            }
        }

        if (isset($data['jumlah']) || isset($data['menu_id'])) {
            $pesanan->total_harga = $pesanan->harga_satuan * $pesanan->jumlah;
        }

        return $pesanan->save();
    }

    public static function deletePesanan(string $id): bool
    {
        $pesanan = self::find($id);
        if (!$pesanan) {
            return false;
        }

        return $pesanan->delete();
    }
}
