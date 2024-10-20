@extends('layouts.app_sneate_wali')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">TAGIHAN SISWA {{ strtoupper($siswa->nama) }}</div>

                <div class="card-body">

                    <a href="{{ route('wali.tagihan.index') }}" class="btn btn-danger my-2 btn-sm">Kembali</a>


                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td rowspan="8" width="100" class="align-top">
                                        <img src="{{ $siswa->foto != null ? \Storage::url($siswa->foto) : asset('images/noimage.png') }}"
                                            alt="{{ $siswa->nama }}" width="100">
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
                                <tr>
                                    <td>Jurusan</td>
                                    <td>:</td>
                                    <td>{{ $siswa->jurusan }}</td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>:</td>
                                    <td>{{ $siswa->angkatan }}</td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td>{{ $siswa->kelas }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <table>
                                <tr>
                                    <td width="40%">No. Tagihan</td>
                                    <td width="5%">:</td>
                                    <td>{{ $tagihan->id }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Tagihan</td>
                                    <td>:</td>
                                    <td>{{ $tagihan->tanggal_tagihan->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Jatuh Tempo</td>
                                    <td>:</td>
                                    <td>{{ $tagihan->tanggal_jatuh_tempo->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $tagihan->getStatusTagihanWali() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="" target="_blank"><i class="fas fa-file"></i> &nbsp; Cetak Invoice
                                            Tagihan</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-primary table-sm">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <td width="5%">No.</td>
                                    <td>Nama Tagihan</td>
                                    <td>Jumlah Tagihan</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan->tagihanDetails as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td class="text-center">{{ $item->nama_biaya }}</td>
                                        <td class="text-end">{{ formatRupiah($item->jumlah_biaya) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-danger">
                                    <td colspan="2" class="text-center fw-bold">Total Pembayaran</td>
                                    <td class="text-end fw-bold">
                                        {{ formatRupiah($tagihan->tagihanDetails->sum('jumlah_biaya')) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>


                        <div class="alert alert-secondary mt-4" role="alert">
                            Pembayaran bisa dilakukan dengancara langsung ke Operator sekolah atau di tranfer melalui
                            rekening milik sekolah dibawah ini: <br>

                            <i class="text-danger"><u>Jangan melakukan tranfer ke rekening selain dari rekening dibawah
                                    ini</u></i>

                            <br>
                            Silahkan lihat tatacara melakukan pembayaran melalui <a href="">ATM</a> atau <a
                                href="">Internet Banking</a>. <br>
                            Setelah melakukan pembayaran, silahkan lakukan upload bukti pembayaran melalui tombol
                            konfirmasi
                            yang ada dibawah ini.
                        </div>

                        <ul>
                            <li>
                                <a href="">Lihat cara melakukan pembayaran dengan tranfer melalui ATM</a>
                            </li>
                            <li>
                                <a href="">Lihat cara melakukan pembayaran dengan tranfer melalui Internet
                                    Banking</a>
                            </li>
                        </ul>



                        <div>
                            <div class="row">

                                @foreach ($banksekolah as $itemBank)
                                    <div class="col-md-6">
                                        <div class="alert alert-primary" role="alert">
                                            <table width="100%" class="text-dark">
                                                <tr>
                                                    <td width="30%">Bank Tujuan</td>
                                                    <td width="5%">:</td>
                                                    <td>{{ $itemBank->nama_bank }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Rekening</td>
                                                    <td>:</td>
                                                    <td>{{ $itemBank->nomor_rekening }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Atas Nama</td>
                                                    <td>:</td>
                                                    <td>{{ $itemBank->nama_rekening }}</td>
                                                </tr>
                                            </table>

                                            <a href="{{ route('wali.pembayaran.create', [
                                                'tagihan_id' => $tagihan->id,
                                                'bank_sekolah_id' => $itemBank->id,
                                            ]) }}"
                                                class="btn btn-primary btn-sm mt-3">Konfirmasi Pembayaran</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
