@extends('layouts.app_sneate')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">

                    <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary my-2 btn-sm">Tambah Data</a>

                    <div class="table-responsive">
                        <table class="table table-striped mb-2">
                            <thead class="text-center">
                                <th width="5%">No.</th>
                                <th>Nama Bank</th>
                                <th>Kode Tranfer</th>
                                <th>Pemilik Rekening</th>
                                <th>Nomor Rekening</th>
                                <th width="20%">Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}.</th>
                                        <th>{{ $item->nama_bank }}</th>
                                        <th>{{ $item->kode }}</th>
                                        <th>{{ $item->nama_rekening }}</th>
                                        <th>{{ $item->nomor_rekening }}</th>
                                        <th class="text-center">


                                            {!! Form::open([
                                                'route' => [$routePrefix . '.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Yakin akan menghapus data ini..?")',
                                            ]) !!}


                                            <a href="{{ route($routePrefix . '.edit', $item->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa-solid fa-pencil"></i></a>

                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                            {!! Form::close() !!}
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak ada.</td>
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
