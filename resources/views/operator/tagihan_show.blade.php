@extends('layouts.app_sneate')

@push('css')
@endpush

@push('js')
    <script src="{{ asset('assets') }}/js/jquery.mask.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
        });
    </script>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">TAGIHAN SPP SISWA {{ strtoupper($periode) }}</h5>
                <div class="card-body">

                    <table class="table table-sm">
                        <tr>
                            <td rowspan="8" width="100">
                                <img src="{{ \Storage::url($siswa->foto) }}" alt="{{ $siswa->nama }}" width="150">
                            </td>
                        </tr>
                        <tr>
                            <td width="50">NISN</td>
                            <td width="5">:</td>
                            <td>{{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $siswa->nama }}</td>
                        </tr>
                    </table>

                </div>

                <div class="card-footer">
                    <a href="{{ route('kartuspp.index', [
                        'siswa_id' => $siswa->id,
                        'tahun' => request('tahun'),
                    ]) }}"
                        class="btn btn-primary btn-sm"><i class="fas fa-file"></i> Kartu Tagihan 2024</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-5">
            <div class="card">
                <h5 class="card-header">Data Tagihan {{ ucwords($periode) }}</h5>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-primary table-sm">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <td>No.</td>
                                    <td>Nama Tagihan</td>
                                    <td>Jumlah Tagihan</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan->tagihanDetails as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $item->nama_biaya }}</td>
                                        <td>{{ formatRupiah($item->jumlah_biaya) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-danger">
                                    <td colspan="2">Total Pembayaran</td>
                                    <td>{{ formatRupiah($tagihan->tagihanDetails->sum('jumlah_biaya')) }}</td>
                                </tr>
                            </tfoot>
                        </table>



                    </div>


                </div>

                <div class="card">
                    <h5 class="card-header">DATA PEMBAYARAN</h5>
                    <div class="card-body">

                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>Tanggal</td>
                                    <td>Jumlah</td>
                                    <td>Metode Bayar</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan->pembayaran as $item)
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{ route('kwitansipembayaran.show', $item->id) }}" target="_blank"><i
                                                    class="fa fa-print"></i></a>
                                        </td>
                                        <td>{{ $item->tanggal_bayar->translatedFormat('d/m/Y') }}</td>
                                        <td>{{ formatRupiah($item->jumlah_dibayar) }}</td>
                                        <td>{{ $item->metode_pembayaran }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <h5 class="my-3">Status Pembayaran : {{ strtoupper($tagihan->status) }}</h5>


                        <hr>
                        <h5>FORM PEMBAYARAN</h5>

                        {!! Form::model($model, ['route' => 'pembayaran.store', 'method' => 'POST']) !!}
                        {!! Form::hidden('tagihan_id', $tagihan->id, []) !!}

                        <div class="form-group mb-2">
                            <label for="tanggal_bayar" class="mb-1">Tanggal Pembayaran</label>
                            {!! Form::date('tanggal_bayar', $model->tanggal_tagihan ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                        </div>

                        <div class="form-group mb-2">
                            <label for="jumlah_dibayar" class="mb-1">Jumlah Yang Dibayarkan</label>
                            {!! Form::text('jumlah_dibayar', null, ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
                        </div>

                        <div class="d-grid gap-2">
                            {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary mt-3']) !!}
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">

        </div>
    </div>
@endsection
