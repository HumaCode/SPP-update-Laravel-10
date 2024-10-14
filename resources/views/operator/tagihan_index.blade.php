@extends('layouts.app_sneate')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary my-2 btn-sm">Tambah
                                Data</a>
                        </div>
                        <div class="col-md-6">
                            {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                            <div class="row ">
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        {!! Form::selectRange('tahun', 2023, date('Y') + 1, request('tahun'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        <button type="submit" class="btn btn-primary">Tampilkan Data</button>

                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped mb-2">
                            <thead class="text-center">
                                <th width="5%">No.</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Tagihan</th>
                                <th>Status</th>
                                <th>Total Tagihan</th>
                                <th width="20%">Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}.</th>
                                        <th>{{ $item->siswa->nisn }}</th>
                                        <th>{{ $item->siswa->nama }}</th>
                                        <th class="text-center">{{ $item->tanggal_tagihan->format('d M Y') }}</th>
                                        <th class="text-center">{{ $item->status }}</th>
                                        <th class="text-center">
                                            {{ formatRupiah($item->tagihanDetails->sum('jumlah_biaya')) }}</th>
                                        <th class="text-center">


                                            {!! Form::open([
                                                'route' => [$routePrefix . '.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Yakin akan menghapus data ini..?")',
                                            ]) !!}

                                            <a href="{{ route($routePrefix . '.show', [
                                                $item->id,
                                                'siswa_id' => $item->siswa_id,
                                                'bulan' => $item->tanggal_tagihan->format('m'),
                                                'tahun' => $item->tanggal_tagihan->format('Y'),
                                            ]) }}"
                                                class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>

                                            {{-- <a href="{{ route($routePrefix . '.edit', $item->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa-solid fa-pencil"></i></a> --}}

                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                            {!! Form::close() !!}
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ada.</td>
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
