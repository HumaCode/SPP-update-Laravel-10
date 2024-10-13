@extends('layouts.app_sneate')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <a href="{{ route($routePrefix . '.index') }}" class="btn btn-danger my-2 btn-sm">Kembali</a>


                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}

                    <div class="form-group mb-2">
                        <label for="name">Nama</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nohp">No. Hp</label>
                        {!! Form::number('nohp', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nohp') }}</span>
                    </div>

                    @if (\Route::is('user.create'))
                        <div class="form-group mb-2">
                            <label for="akses">Hak Akses</label>
                            {!! Form::select(
                                'akses',
                                [
                                    'operator' => 'Operator Sekolah',
                                    'admin' => 'Administrator',
                                    // 'wali' => 'Wali Murid',
                                ],
                                null,
                                ['class' => 'form-control'],
                            ) !!}
                            <span class="text-danger">{{ $errors->first('akses') }}</span>
                        </div>
                    @endif


                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>

                    {!! Form::submit($button, ['class' => 'btn btn-primary my-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
