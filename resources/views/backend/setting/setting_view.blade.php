@extends('admin.admin_master')

@section('admin')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Настройки</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                    <li class="breadcrumb-item active">Настройки</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                    </div> -->
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($setting == null)
                        <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Логотип</label>
                                        <input type="file" name="logo" class="form-control-file"
                                               id="exampleFormControlFile1">
                                        @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Адрес</label>
                                        <input type="text" name="address"
                                               class="form-control">
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Адресный номер</label>
                                        <input type="text" name="address_number"
                                               class="form-control">
                                        @error('address_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Первый телефон</label>
                                        <input type="text" name="first_phone"
                                               class="form-control">
                                        @error('first_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Второй телефон</label>
                                        <input type="text" name="second_phone"
                                               class="form-control">
                                        @error('second_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ссылка на Facebook</label>
                                        <input type="text" name="facebook_url"
                                               class="form-control">
                                        @error('facebook_url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Электронная почта</label>
                                        <input type="text" name="email"
                                               class="form-control">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>О компании</label>
                                        <textarea name="about" class="form-control"></textarea>
                                        @error('about')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Цель</label>
                                        <textarea name="target" class="form-control"></textarea>
                                        @error('target')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-rounded btn-primary btn-sm"
                                               value="Добавлять">
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Логотип</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    <img src="{{ asset($setting->logo) }}" class="img-thumbnail">
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Адрес</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    {{ $setting->address }}
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Адресный номер</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    {{ $setting->address_number }}
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Первый телефон</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    {{ $setting->first_phone }}
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Второй телефон</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    {{ $setting->second_phone }}
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Ссылка на Facebook</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    <a href="{{ $setting->facebook_url }}" target="_blank">Ссылка</a>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Электронная почта</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    {{ $setting->email }}
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">О компании</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    {!! $setting->about !!}
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                                <span
                                                    class="info-box-text text-center text-muted">Цель</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                                    {!! $setting->target !!}
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('setting.edit', $setting->id) }}"
                                       class="btn btn-primary float-right btn-sm">Изменять</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
