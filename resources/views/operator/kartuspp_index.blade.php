@extends('layouts.app_sneate_blank')

@section('content')
{{--  <script>
    window.print()
</script>  --}}

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-uppercase">KARTU SPP</h1>
                        <div class="billed"><span class="font-weight-bold">Nama Sekolah :</span> SMK Muhammadiyah Kajen</div>
                        <div class="billed"><span class="font-weight-bold">Nama Siswa :</span> {{ $siswa->nama }}</div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Bulan Tagihan</th>
                                    <th>Item Tagihan</th>
                                    <th>Jumlah</th>
                                    <th>Paraf</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tagihan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $item->tanggal_tagihan->translatedFormat('F Y') }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($item->tagihanDetails as $itemDetails)
                                                    <li>
                                                        {{ $itemDetails->nama_biaya }} -
                                                        {{ formatRupiah($itemDetails->jumlah_biaya) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ formatRupiah($item->tagihanDetails->sum('jumlah_biaya')) }}</td>
                                        <td>{{ $item->metode_bayar }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
