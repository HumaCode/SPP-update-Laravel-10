@extends('layouts.app_sneate')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">

                    <a href="{{ route($routePrefix . '.index') }}" class="btn btn-danger my-2 btn-sm">Kembali</a>

                    <div class="table-responsive">

                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <td width="15%">ID</td>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <td>NAMA</td>
                                    <td>{{ $model->name }}</td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>{{ $model->email }}</td>
                                </tr>
                                <tr>
                                    <td>NO. HP</td>
                                    <td>{{ $model->nohp }}</td>
                                </tr>
                                <tr>
                                    <td>TGL DIBUAT</td>
                                    <td>{{ $model->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>TGL DIUBAH</td>
                                    <td>{{ $model->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </thead>
                        </table>

                        <h4 class="mt-3">TAMBAH DATA ANAK</h4>
                        {!! Form::open(['route' => 'walisiswa.store', 'method' => 'POST']) !!}
                        {!! Form::hidden('wali_id', $model->id, []) !!}

                        <div class="input-group">
                            {!! Form::select('siswa_id', $siswa, null, ['class' => 'form-control select2', 'placeholder' => '--Pilih--']) !!}
                            <span class="text-danger">{{ $errors->first('siswa_id') }}</span>
                        </div>

                        {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary my-2']) !!}
                        {!! Form::close() !!}

                        <h4 class="my-3">DATA ANAK</h4>

                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <td width="5%">No.</td>
                                    <td>NISN</td>
                                    <td>NAMA</td>
                                    <td>AKSI</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($model->siswa as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-center" width="15%">
                                            {!! Form::open([
                                                'route' => ['walisiswa.update', $item->id],
                                                'method' => 'PUT',
                                                'onsubmit' => 'return confirm("Yakin akan menghapus data ini..?")',
                                            ]) !!}

                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center"><strong>Data tidak ada.</strong></td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
