<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class WaliSiswaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wali_id'   => 'required|exists:users,id',
            'siswa_id'  => 'required',
        ]);

        $wali   = User::find($request->wali_id);
        $siswa  = Siswa::find($request->siswa_id);

        $siswa->wali_id         = $request->wali_id;
        $siswa->wali_status     = 'ok';
        $siswa->save();

        flash('Data berhasil ditambahkan')->success();
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->wali_id         = null;
        $siswa->wali_status     = null;
        $siswa->save();

        flash('Data berhasil dihapus')->success();
        return back();
    }
}
