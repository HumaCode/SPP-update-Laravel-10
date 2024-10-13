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


                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true]) !!}

                    <div class="form-group mb-2">
                        <label for="wali_id">Nama Wali Murid (optional)</label>
                        {!! Form::select('wali_id', $wali, null, [
                            'class' => 'form-control select2',
                            'placeholder' => '-- Pilih Wali Murid --',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('wali_id') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nama">Nama</label>
                        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nisn">NISN</label>
                        {!! Form::text('nisn', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nisn') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="jurusan">Jurusan</label>
                        {!! Form::select(
                            'jurusan',
                            [
                                'RPL' => 'Rekayasa Perangkat Lunak',
                                'TKJ' => 'Teknik Komputer dan Jaringan',
                                'TKR' => 'Teknik Kendaraan Ringan',
                                'TAV' => 'Teknik Audio Video',
                                'TKI' => 'Teknik Kimia Industri',
                            ],
                            null,
                            ['class' => 'form-control', 'placeholder' => '-- Pilih Jurusan --'],
                        ) !!}
                        <span class="text-danger">{{ $errors->first('jurusan') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="kelas">Kelas</label>
                        {!! Form::selectRange('kelas', 10, 12, null, ['class' => 'form-control', 'placeholder' => '-- Pilih Kelas --']) !!}
                        <span class="text-danger">{{ $errors->first('kelas') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="angkatan">Angkatan</label>
                        {!! Form::selectRange('angkatan', 2024, date('Y') + 1, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Pilih Angkatan --',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                    </div>

                    @if ($model->foto != null)
                        <img src="{{ \Storage::url($model->foto) }}" class="my-3" width="200" alt="">
                    @endif

                    <div class="form-group mb-2">
                        <label for="foto">Foto <small class="text-danger">Format harus jpg, Ukuran maksimal
                                2MB.</small></label>
                        {!! Form::file('foto', ['class' => 'form-control', 'accept' => '.jpg']) !!}
                        <span class="text-danger">{{ $errors->first('foto') }}</span>
                    </div>

                    {!! Form::submit($button, ['class' => 'btn btn-primary my-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
