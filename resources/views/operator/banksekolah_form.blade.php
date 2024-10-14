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


                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}


                    <div class="form-group mb-2">
                        <label for="id">Nama Bank</label>
                        {!! Form::select('id', $listbank, null, [
                            'class' => 'form-control select2',
                            'placeholder' => '-- Pilih Bank --',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nama_rekening">Pemilik Rekening</label>
                        {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('pemilik_rekening') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nomor_rekening">Nomor Rekening</label>
                        {!! Form::number('nomor_rekening', null, ['class' => 'form-control', 'min' => 0]) !!}
                        <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                    </div>


                    {!! Form::submit($button, ['class' => 'btn btn-primary my-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
