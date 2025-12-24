<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutNContact extends Model
{
    protected $table = 'about_ncontact';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'about_deskripsi',
        'contact_deskripsi',
    ];

    // Fungsi untuk ambil deskripsi dengan decode Quill (HTML)
    public function getDecodedAbout()
    {
        return $this->about_deskripsi;
    }

    public function getDecodedContact()
    {
        return $this->contact_deskripsi;
    }
}

