@extends('layouts.app_sneate_wali')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">DATA TAGIHAN SPP</div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped mb-2">
                            <thead class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Tanggal Tagihan</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($tagihan as $item)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}.</th>
                                        <th>{{ $item->siswa->nama }}</th>
                                        <th>{{ $item->siswa->jurusan }}</th>
                                        <th>{{ $item->siswa->kelas }}</th>
                                        <th>{{ $item->tanggal_tagihan->translatedFormat('F Y') }}</th>
                                        <th class="text-center">{{ $item->getStatusTagihanWali() }}</th>
                                        <th>
                                            @if ($item->status == 'baru' || $item->status == 'angsur')
                                                <a href="{{ route('wali.tagihan.show', $item->id) }}"
                                                    class="btn btn-primary btn-sm">Lakukan Pembayaran</a>
                                            @else
                                                <a href="" class="btn btn-success btn-sm">Pembayaran Sudah Lunas</a>
                                            @endif
                                        </th>
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
