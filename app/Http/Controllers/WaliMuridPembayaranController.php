<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankSekolah;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class WaliMuridPembayaranController extends Controller
{
    public function create(Request $request)
    {
        $data['tagihan']            = Tagihan::waliSiswa()->findOrFail($request->tagihan_id);
        // $data['bankSekolah']    = BankSekolah::findOrFail($request->bank_sekolah_id);
        $data['listBankSekolah']    = BankSekolah::pluck('nama_bank', 'id');
        $data['listBank']           = Bank::pluck('nama_bank', 'id');

        $data['model']              = new Pembayaran();
        $data['method']             = 'POST';
        $data['route']              = 'wali.pembayaran.store';

        if ($request->bank_sekolah_id != '') {
            $data['bankYangDipilih'] = BankSekolah::find($request->bank_sekolah_id);
        }

        $data['url']             =  route('wali.pembayaran.create', [
            'tagihan_id' => $request->tagihan_id,
        ]);


        return view('wali.pembayaran_form', $data);
    }
}
