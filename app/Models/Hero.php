<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Hero extends Model
{
    protected $table = 'heroes';
    protected $keyType = 'string'; // UUID
    public $incrementing = false;

    protected $fillable = [
        'id',
        'gambar',
        'status',
    ];

    // Generate UUID saat create
    protected static function booted()
    {
        static::creating(function ($hero) {
            if (!$hero->id) {
                $hero->id = (string) Str::uuid();
            }
        });

        // Hapus gambar saat record dihapus
        static::deleting(function ($hero) {
            if ($hero->gambar) {
                $path = storage_path('app/public/uploads/hero/' . $hero->gambar);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        });
    }


}

