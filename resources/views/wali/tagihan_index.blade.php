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
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Tanggal Tagihan</th>
                                <th>Status Pembayaran</th>
                            </thead>
                            <tbody>
                                @forelse ($tagihan as $item)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}.</th>
                                        <th>{{ $item->siswa->name }}</th>
                                        <th>{{ $item->siswa->jurusan }}</th>
                                        <th>{{ $item->siswa->kelas }}</th>
                                        <th>{{ $item->tanggal_tagihan->format('d M Y') }}</th>
                                        <th class="text-center">{{ $item->getStatusTagihanWali() }}</th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak ada.</td>
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
