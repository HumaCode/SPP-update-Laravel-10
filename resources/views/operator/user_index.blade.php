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
                                <th>No.</th>
                                <th>Nama</th>
                                <th>No. Hp</th>
                                <th>Email</th>
                                <th>Akses</th>
                                <th width="30%">Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}.</th>
                                        <th>{{ $item->name }}</th>
                                        <th>{{ $item->nohp }}</th>
                                        <th>{{ $item->email }}</th>
                                        <th>{{ $item->akses }}</th>
                                        <th>


                                            {!! Form::open([
                                                'route' => [$routePrefix . '.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Yakin akan menghapus data ini..?")',
                                            ]) !!}

                                            <a href="{{ route($routePrefix . '.edit', $item->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa-solid fa-pencil"></i> &nbsp;
                                                Edit</a>

                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa-solid fa-trash-can"></i> &nbsp; Hapus</button>
                                            {!! Form::close() !!}
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Data tidak ada.</td>
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
