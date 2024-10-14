@extends('layouts.app_sneate_blank')

@section('content')
<script>
    window.print()
</script>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-uppercase">KWITANSI PEMBAYARAN</h1>
                        <div class="billed"><span class="font-weight-bold">Nama Sekolah :</span> SMK Muhammadiyah Kajen</div>
                        <div class="billed"><span class="font-weight-bold">Tanggal Tagihan :</span> {{ $pembayaran->tanggal_bayar->translatedFormat('d F Y') }}</div>
                        <div class="billed"><span class="font-weight-bold">Pembayaran ID :</span> {{ $pembayaran->id }}</div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Metode Bayar</th>
                                    <th>Jumlah Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td>{{ $pembayaran->tanggal_bayar->translatedFormat('d/m/Y') }}</td>
                                        <td>{{ formatRupiah($pembayaran->jumlah_dibayar) }}</td>
                                        <td>{{ $pembayaran->metode_pembayaran }}</td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-right mx-3">
                    <div class="alert alert-primary">
                        <i><strong>Terbilang : {{ ucwords(terbilang($pembayaran->jumlah_dibayar)) }} Rupiah</strong></i>
                    </div>
                </div>


                <div class="">
                    Pekalongan, {{ $pembayaran->tanggal_bayar->translatedFormat('d F Y') }}

                    <br>
                    <br>
                    <br>
                    <br>

                    <u>Operator {{ $pembayaran->user->name }}</u>

                </div>


            </div>
        </div>
    </div>
</div>

@endsection
