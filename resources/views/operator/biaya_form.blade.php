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


                    <div class="form-group mb-2">
                        <label for="nama">Nama Biaya</label>
                        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="jumlah">Jumlah / Nominal</label>
                        {!! Form::text('jumlah', null, ['class' => 'form-control rupiah']) !!}
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                    </div>


                    {!! Form::submit($button, ['class' => 'btn btn-primary my-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
