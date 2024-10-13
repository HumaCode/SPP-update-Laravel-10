<?php

namespace App\Http\Controllers;

use App\Models\User as Model;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $viewIndex      = 'user_index';
    private $viewCreate     = 'user_form';
    private $viewEdit       = 'user_form';
    private $viewShow       = 'user_show';
    private $routePrefix    = 'user';
    private $title          = 'Data User';



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('operator.' . $this->viewIndex, [
            'models'        => Model::where('akses', '<>', 'wali')->latest()->paginate(10),
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
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'nohp'      => 'required|unique:users,nohp',
            'akses'     => 'required|in:operator,admin',
            'password'  => 'required',
        ]);

        $requestData['password']                = bcrypt($requestData['password']);
        $requestData['email_verified_at']       = now();

        Model::create($requestData);
        flash('Data Berhasil Ditambahkan..')->success();
        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $id,
            'nohp'      => 'required|unique:users,nohp,' . $id,
            'akses'     => 'required|in:operator,admin',
            'password'  => 'nullable',
        ]);

        $model = Model::findOrFail($id);
        if ($requestData['password'] == "") {
            unset($requestData['password']);
        } else {
            $requestData['password'] = bcrypt($requestData['password']);
        }

        $model->fill($requestData);
        $model->save();


        flash('Data Berhasil Diubah..')->success();
        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Model::findOrFail($id);

        if ($model->id == 1) {
            flash('Data Tidak Dapat Dihapus..')->error();
            return back();
        }

        $model->delete();
        flash('Data Berhasil Dihapus..')->success();
        return back();
    }
}
