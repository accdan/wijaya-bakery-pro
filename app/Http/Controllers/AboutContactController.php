<?php

namespace App\Http\Controllers;

use App\Models\AboutNContact;
use Illuminate\Http\Request;

class AboutContactController extends Controller
{
    // Tampilkan form edit (asumsinya hanya ada 1 data)
    public function index()
    {
        // Jika belum ada record, buat record baru
        $data = AboutNContact::firstOrCreate(
            [], // Tidak ada kondisi, buat record baru jika belum ada
            [
                'about_deskripsi' => 'Selamat datang di Wijaya Bakery. ',
                'contact_deskripsi' => 'Hubungi kami untuk informasi lebih lanjut.'
            ]
        );

        return view('admin.about_contact.index', compact('data'));
    }

    // Simpan atau update
    public function update(Request $request, $id)
    {
        $request->validate([
            'about_deskripsi'   => 'nullable|string',
            'contact_deskripsi' => 'nullable|string',
        ]);

        $data = AboutNContact::firstOrNew(['id' => $id]);

        // Simpan deskripsi saja
        $data->about_deskripsi   = $request->about_deskripsi;
        $data->contact_deskripsi = $request->contact_deskripsi;

        $data->save();

        return redirect()->back()->with('success', 'Data About & Contact berhasil disimpan.');
    }
}

