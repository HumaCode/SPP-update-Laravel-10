<?php

namespace App\Http\Controllers;

use App\Models\Tagihan as Model;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use App\Models\Biaya;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\TagihanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    private $viewIndex      = 'tagihan_index';
    private $viewCreate     = 'tagihan_form';
    private $viewEdit       = 'tagihan_form';
    private $viewShow       = 'tagihan_show';
    private $routePrefix    = 'tagihan';
    private $title          = 'Data Tagihan';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('bulan') && $request->filled('tahun')) {

            $models = Model::whereMonth('tanggal_tagihan', $request->bulan)
                ->whereYear('tanggal_tagihan', $request->tahun)
                ->latest('id')
                ->paginate(10);
        } else {
            $models = Model::latest('id')
                ->paginate(10);
        }


        return view('operator.' . $this->viewIndex, [
            'models'        => $models,
            'title'         => $this->title,
            'routePrefix'   => $this->routePrefix,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $data = [
            'model'         => new Model(),
            'method'        => 'POST',
            'route'         => $this->routePrefix . '.store',
            'button'        => 'SIMPAN',
            'routePrefix'   => $this->routePrefix,
            'title'         => 'Tambah ' . $this->title,
            'angkatan'      => $siswa->pluck('angkatan', 'angkatan'),
            'kelas'         => $siswa->pluck('kelas', 'kelas'),
            'biaya'         => Biaya::get(),
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagihanRequest $request)
    {
        $requestData = $request->validated();
        $biayaIdArray = $requestData['biaya_id'];

        $siswa = Siswa::query();
        if ($requestData['kelas'] != '') {
            $siswa->where('kelas', $requestData['kelas']);
        }
        if ($requestData['angkatan'] != '') {
            $siswa->where('angkatan', $requestData['angkatan']);
        }
        $siswa = $siswa->get();

        foreach ($siswa as $itemSiswa) {

            $biaya = Biaya::whereIn('id', $biayaIdArray)->get();
            unset($requestData['biaya_id']);
            $requestData['siswa_id']        = $itemSiswa->id;
            $requestData['status']          = 'baru';

            // cek apakah tagihan user sudah ada sebelumnya
            $tanggalTagihan     = Carbon::parse($requestData['tanggal_tagihan']);
            $bulanTagihan       = $tanggalTagihan->format('m');
            $tahunTagihan       = $tanggalTagihan->format('Y');
            $cekTagihan         = Model::where('siswa_id', $itemSiswa->id)
                ->whereMonth('tanggal_tagihan', $bulanTagihan)
                ->whereYear('tanggal_tagihan', $tahunTagihan)
                ->first();

            if ($cekTagihan == null) {
                $tagihan = Model::create($requestData);

                foreach ($biaya as $itemBiaya) {
                    $detail = TagihanDetail::create([
                        'tagihan_id'    => $tagihan->id,
                        'nama_biaya'    => $itemBiaya->nama,
                        'jumlah_biaya'  => $itemBiaya->jumlah,
                    ]);
                }
            }
        }

        flash($this->title . ' Berhasil Disimpan.')->success();
        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $tagihan = Model::with('pembayaran')->findOrFail($id);

        $data['tagihan']    = $tagihan;
        $data['siswa']      = $tagihan->siswa;
        $data['periode']    = 'Bulan ' . Carbon::parse($tagihan->tanggal_tagihan)->translatedFormat('F Y');
        $data['model']      = new Pembayaran();


        return view('operator.' . $this->viewShow, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Model $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagihanRequest $request, Model $tagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $tagihan)
    {
        //
    }
}
