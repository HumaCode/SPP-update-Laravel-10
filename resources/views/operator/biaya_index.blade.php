@extends('layouts.app_sneate')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">

                    <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary my-2 btn-sm">Tambah Data</a>

                    {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                    <div class="input-group my-3">
                        <input type="text" name="q" class="form-control" placeholder="Cari Data"
                            aria-label="Cari Data" aria-describedby="button-addon2" autofocus value="{{ request('q') }}">
                        <button type="submit" class="btn btn-outline-primary" id="button-addon2">Cari
                            Data</button>
                    </div>
                    {!! Form::close() !!}

                    <div class="table-responsive">
                        <table class="table table-striped mb-2">
                            <thead class="text-center">
                                <th width="5%">No.</th>
                                <th>Nama Biaya</th>
                                <th>Jumlah</th>
                                <th>Created By</th>
                                <th width="20%">Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}.</th>
                                        <th>{{ $item->nama }}</th>
                                        <th>{{ $item->formatRupiah('jumlah') }}</th>
                                        <th>{{ $item->user->name }}</th>
                                        <th class="text-center">


                                            {!! Form::open([
                                                'route' => [$routePrefix . '.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Yakin akan menghapus data ini..?")',
                                            ]) !!}

                                            <a href="{{ route($routePrefix . '.show', $item->id) }}"
                                                class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>

                                            <a href="{{ route($routePrefix . '.edit', $item->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa-solid fa-pencil"></i></a>

                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                            {!! Form::close() !!}
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data tidak ada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $models->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
