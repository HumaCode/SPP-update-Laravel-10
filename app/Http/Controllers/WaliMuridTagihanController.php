<?php

namespace App\Http\Controllers;

use App\Models\BankSekolah;
use App\Models\Tagihan;

class WaliMuridTagihanController extends Controller
{
    public function index()
    {
        $data['tagihan']    = Tagihan::WaliSiswa()->get();

        return view('wali.tagihan_index', $data);
    }

    public function show($id)
    {
        $tagihan = Tagihan::WaliSiswa()->findOrFail($id);
        $data['tagihan']        = $tagihan;
        $data['siswa']          = $tagihan->siswa;
        $data['banksekolah']    = BankSekolah::all();

        return view('wali.tagihan_show', $data);
    }
}
