<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Siswa as Model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    private $viewIndex      = 'siswa_index';
    private $viewCreate     = 'siswa_form';
    private $viewEdit       = 'siswa_form';
    private $viewShow       = 'siswa_show';
    private $routePrefix    = 'siswa';
    private $title          = 'Data Siswa';


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::with('wali', 'user')->search($request->q)->latest()->paginate(10);
        } else {
            $models = Model::with('wali', 'user')->latest()->paginate(10);
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
        $data = [
            'model'         => new Model(),
            'method'        => 'POST',
            'route'         => $this->routePrefix . '.store',
            'button'        => 'SIMPAN',
            'routePrefix'   => $this->routePrefix,
            'title'         => 'Tambah ' . $this->title,
            'wali'          => User::where('akses', 'wali')->pluck('name', 'id'),
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $requestData = $request->validated();

        if ($request->file('foto')) {
            $requestData['foto']        = $request->file('foto')->store('public');
        }

        if ($request->filled('wali_id')) {
            $requestData['wali_status']     = 'ok';
        }

        $requestData['user_id']         = Auth::user()->id;

        Model::create($requestData);
        flash($this->title . ' Berhasil Ditambahkan..')->success();
        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('operator.' . $this->viewShow, [
            'model'         => Model::findOrFail($id),
            'title'         => 'Detail ' . $this->title,
            'routePrefix'   => $this->routePrefix,
        ]);
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
            'wali'          => User::where('akses', 'wali')->pluck('name', 'id'),
        ];

        return view('operator.' . $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, string $id)
    {
        $requestData = $request->validated();

        $model = Model::findOrFail($id);

        if ($request->file('foto')) {
            if ($model->foto != null) {
                Storage::delete($model->foto);
            }
            $requestData['foto']            = $request->file('foto')->store('public');
        }

        if ($request->filled('wali_id')) {
            $requestData['wali_status']     = 'ok';
        }

        $requestData['user_id']             = Auth::user()->id;

        $model->fill($requestData);
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
        if ($model->foto != null) {
            Storage::delete($model->foto);
        }

        $model->delete();
        flash($this->title . ' Berhasil Dihapus..')->success();
        return back();
    }
}
