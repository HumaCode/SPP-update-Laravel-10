<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiayaRequest;
use App\Http\Requests\UpdateBiayaRequest;
use App\Models\Biaya as Model;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    private $viewIndex      = 'biaya_index';
    private $viewCreate     = 'biaya_form';
    private $viewEdit       = 'biaya_form';
    private $viewShow       = 'biaya_show';
    private $routePrefix    = 'biaya';
    private $title          = 'Data Biaya';


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::with('user')->search($request->q)->latest()->paginate(10);
        } else {
            $models = Model::with('user')->latest()->paginate(10);
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
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBiayaRequest $request)
    {
        Model::create($request->validated());
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
        ];

        return view('operator.' . $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBiayaRequest $request, string $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
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
