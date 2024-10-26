@extends('layouts.app_sneate_wali')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('assets') }}/js/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        $(function() {
            $("#checkboxtoogle").click(function() {
                if ($(this).is(":checked")) {
                    $("#pilihan_bank").fadeOut();
                    $("#form_bank_pengirim").fadeIn();
                } else {
                    $("#pilihan_bank").fadeIn();
                    $("#form_bank_pengirim").fadeOut();
                }
            })
        })


        $(document).ready(function() {


            $('.select2').select2();

            $('.rupiah').mask("#.##0", {
                reverse: true
            });

            $('#pilih_bank').change(function(e) {
                var bankId = $(this).find(":selected").val();

                window.location.href = "{{ $url }}&bank_sekolah_id=" + bankId;
            });

            var countWaliBank = {{ count($listWaliBank) }};

            // Cek kondisi dan sembunyikan atau tampilkan form
            if (countWaliBank >= 1) {
                $("#form_bank_pengirim").hide();
            } else {
                $("#form_bank_pengirim").show();
            }

        });
    </script>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">KONFIRMASI PEMBAYARAN</div>

                <div class="card-body">

                    <a href="{{ route('wali.tagihan.show', $tagihan->id) }}" class="btn btn-danger my-2 btn-sm">Kembali</a>

                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}

                    <div class="divider">
                        <div class="divider-text">
                            <i class='bx bxs-info-circle'></i> &nbsp; INFORMASI REKENING PENGIRIM
                        </div>
                    </div>


                    <div class="card mb-3" style="background-color: rgb(236, 236, 236)">
                        <div class="card-body text-dark">

                            @if (count($listWaliBank) >= 1)
                                <div class="form-group mb-3" id="pilihan_bank">
                                    <label for="wali_bank_id" class="mb-2">Pilih Bank Pengirim</label>
                                    {!! Form::select('wali_bank_id', $listWaliBank, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => '-- Pilih Nomor Rekening Pengirim --',
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('wali_bank_id') }}</span>
                                </div>


                                <div class="form-check mb-3">
                                    {!! Form::checkbox('pilihan_bank', 1, false, ['class' => 'form-check-input', 'id' => 'checkboxtoogle']) !!}
                                    <label class="form-check-label" for="checkboxtoogle"> Saya Menggunakan Rekening Lain.
                                    </label>
                                </div>
                            @endif


                            <div id="form_bank_pengirim">
                                <hr>
                                <div class="alert alert-danger" role="alert"><i
                                        class="fa-solid fa-triangle-exclamation"></i>
                                    &nbsp;
                                    Informasi ini dibutuhkan agar operator sekolah dapat memverifikasi pembayaran yang
                                    dilakukan
                                    oleh wali murid melalui bank.
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nama_bank_pengirim" class="mb-2">Nama Bank Pengirim</label>
                                    {!! Form::select('nama_bank_pengirim', $listBank, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => '-- Pilih Bank --',
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('nama_bank_pengirim') }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nama_rekening" class="mb-2">Nama Pemilik Rekening</label>
                                    {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nomor_rekening" class="mb-2">Nomor Rekening Pengirim
                                    </label>
                                    {!! Form::number('nomor_rekening', null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                                </div>

                                <div class="form-check mb-3">
                                    {!! Form::checkbox('simpan_data_rekening', 1, true, ['class' => 'form-check-input', 'id' => 'defaultCheck1']) !!}
                                    <label class="form-check-label" for="defaultCheck1"> Simpan data ini untuk
                                        memudahkan
                                        pembayaran selanjutnya. </label>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="divider">
                        <div class="divider-text">
                            <i class='bx bxs-info-circle'></i> &nbsp; INFORMASI REKENING TUJUAN
                        </div>
                    </div>

                    <div class="card mb-3" style="background-color: rgb(236, 236, 236)">
                        <div class="card-body text-dark">
                            <div class="form-group mb-3">
                                <label for="bank_id" class="mb-2">Bank Tujuan</label>
                                {!! Form::select('bank_id', $listBankSekolah, request('bank_sekolah_id'), [
                                    'class' => 'form-control',
                                    'placeholder' => '-- Pilih Bank Tujuan Tranfer --',
                                    'id' => 'pilih_bank',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                            </div>

                            @if (request('bank_sekolah_id') != '')
                                <div class="alert alert-danger" role="alert">
                                    <table width="100%" class="text-dark">
                                        <tr>
                                            <td width="30%">Bank Tujuan</td>
                                            <td width="5%">:</td>
                                            <td>{{ $bankYangDipilih->nama_bank }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Rekening</td>
                                            <td>:</td>
                                            <td>{{ $bankYangDipilih->nomor_rekening }}</td>
                                        </tr>
                                        <tr>
                                            <td>Atas Nama</td>
                                            <td>:</td>
                                            <td>{{ $bankYangDipilih->nama_rekening }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="divider">
                        <div class="divider-text">
                            <i class='bx bxs-info-circle'></i> &nbsp; INFORMASI PEMBAYARAN
                        </div>
                    </div>

                    <div class="card mb-3" style="background-color: rgb(236, 236, 236)">
                        <div class="card-body text-dark">

                            <div class="form-group mb-3">
                                <label for="tanggal_bayar" class="mb-2">Tanggal Bayar</label>
                                {!! Form::date('tanggal_bayar', $model->tanggal_bayar ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jumlah_dibayar" class="mb-2">Jumlah Yang Dibayarkan</label>
                                {!! Form::text('jumlah_dibayar', null, ['class' => 'form-control rupiah']) !!}
                                <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
                            </div>

                            <div class="form-group mb-3">
                                <label for="bukti_bayar" class="mb-2">Bukti Pembayaran</label>
                                {!! Form::file('bukti_bayar', ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('bukti_bayar') }}</span>
                            </div>
                        </div>
                    </div>

                    {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
