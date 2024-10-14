<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankSekolahRequest;
use App\Http\Requests\UpdateBankSekolahRequest;
use App\Models\Bank;
use App\Models\BankSekolah as Model;
use Illuminate\Http\Request;

class BankSekolahController extends Controller
{
    private $viewIndex      = 'banksekolah_index';
    private $viewCreate     = 'banksekolah_form';
    private $viewEdit       = 'banksekolah_form';
    private $viewShow       = 'banksekolah_show';
    private $routePrefix    = 'banksekolah';
    private $title          = 'Data Rekening Sekolah';


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Model::latest()->paginate(10);

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
        $data = [
            'model'         => new Model(),
            'method'        => 'POST',
            'route'         => $this->routePrefix . '.store',
            'button'        => 'SIMPAN',
            'routePrefix'   => $this->routePrefix,
            'title'         => 'Tambah ' . $this->title,
            'listbank'      => Bank::pluck('nama_bank', 'id'),
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankSekolahRequest $request)
    {
        $requestData                = $request->validated();
        $bank                       = Bank::find($request['id']);
        unset($requestData['id']);
        $requestData['kode']        = $bank->sandi_bank;
        $requestData['nama_bank']   = $bank->nama_bank;

        Model::create($requestData);

        flash($this->title . ' Berhasil Ditambahkan..')->success();
        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        #
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'model'         => Model::findOrFail($id),
            'method'        => 'PUT',
            'route'         => [$this->routePrefix . '.update', $id],
            'button'        => 'UBAH DATA',
            'routePrefix'   => $this->routePrefix,
            'title'         => 'Ubah ' . $this->title,
            'listbank'      => Bank::pluck('nama_bank', 'id'),
        ];

        return view('operator.' . $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankSekolahRequest $request, string $id)
    {
        $model                      = Model::findOrFail($id);

        $model->fill($request->validated());
        $bank                       = Bank::find($request['id']);
        unset($model['id']);
        $model['kode']        = $bank->sandi_bank;
        $model['nama_bank']   = $bank->nama_bank;


        $model->save();


        flash($this->title . ' Berhasil Diubah..')->success();
        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Model::findOrFail($id);

        $model->delete();
        flash($this->title . ' Berhasil Dihapus..')->success();
        return back();
    }
}
