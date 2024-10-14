@extends('layouts.app_sneate_wali')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">DATA SISWA</div>

                <div class="card-body">

                    <a href="" class="btn btn-primary my-2 btn-sm">Tambah Data</a>


                    <div class="table-responsive">
                        <table class="table table-striped mb-2">
                            <thead class="text-center">
                                <th>No.</th>
                                <th>Nama Wali Murid</th>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Angkatan</th>
                                <th>Created By</th>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}.</th>
                                        <th>{{ $item->wali->name }}</th>
                                        <th>{{ $item->nama }}</th>
                                        <th>{{ $item->nisn }}</th>
                                        <th>{{ $item->jurusan }}</th>
                                        <th>{{ $item->kelas }}</th>
                                        <th>{{ $item->angkatan }}</th>
                                        <th>{{ $item->user->name }}</th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ada.</td>
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
