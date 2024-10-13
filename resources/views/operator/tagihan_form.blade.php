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
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <a href="{{ route($routePrefix . '.index') }}" class="btn btn-danger my-2 btn-sm">Kembali</a>


                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}


                    {{-- <div class="form-group mb-2">
                        <label for="biaya_id">Biaya Yang Ditagihkan</label>
                        {!! Form::select('biaya_id', $biaya, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Pilih Biaya --',
                            'multiple' => true,
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('biaya_id') }}</span>
                    </div> --}}

                    <label class="mb-3" for="">Tagihan Untuk;</label>
                    @foreach ($biaya as $item)
                        <div class="form-check mb-2">
                            {!! Form::checkbox('biaya_id[]', $item->id, null, [
                                'class' => 'form-check-input',
                                'id' => 'defaultCheck1' . $loop->iteration,
                            ]) !!}
                            <label class="form-check-label" for="defaultCheck1{{ $loop->iteration }}">
                                {{ $item->nama_biaya_full }} </label>
                        </div>
                    @endforeach

                    <div class="form-group mb-2">
                        <label for="angkatan">Tagihan Untuk Angkatan</label>
                        {!! Form::select('angkatan', $angkatan, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Pilih Angkatan --',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="kelas">Tagihan Untuk Kelas</label>
                        {!! Form::select('kelas', $kelas, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Pilih Kelas --',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('kelas') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="tanggal_tagihan">Tanggal Tagihan</label>
                        {!! Form::date('tanggal_tagihan', $model->tanggal_tagihan ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_tagihan') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        {!! Form::date('tanggal_jatuh_tempo', $model->tanggal_jatuh_tempo ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_jatuh_tempo') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="keterangan">Keterangan</label>
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>


                    {!! Form::submit($button, ['class' => 'btn btn-primary my-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
