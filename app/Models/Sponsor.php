<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Sponsor extends Model
{
    use SoftDeletes;

    protected $table = 'sponsor';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_sponsor',
        'deskripsi_sponsor',
        'logo_sponsor',
    ];

    protected static function booted()
    {
        static::creating(function ($sponsor) {
            if (!$sponsor->id) {
                $sponsor->id = (string) Str::uuid();
            }
        });
    }

    public static function createSponsor($data)
    {
        return self::create([
            'nama_sponsor' => $data['nama_sponsor'],
            'deskripsi_sponsor' => $data['deskripsi_sponsor'],
            'logo_sponsor' => $data['logo_sponsor'] ?? null,
        ]);
    }

    public function updateSponsor($data)
    {
        return $this->update([
            'nama_sponsor' => $data['nama_sponsor'] ?? $this->nama_sponsor,
            'deskripsi_sponsor' => $data['deskripsi_sponsor'] ?? $this->deskripsi_sponsor,
            'logo_sponsor' => $data['logo_sponsor'] ?? $this->logo_sponsor,
        ]);
    }

    public function deleteSponsor()
    {
        return $this->delete();
    }
}

