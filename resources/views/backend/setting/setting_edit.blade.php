@extends('admin.admin_master')

@section('admin')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Изменить настройки</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главный</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('all.setting') }}">Настройки</a></li>
                        <li class="breadcrumb-item active">Изменить настройки</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('setting.update', $setting->id) }}"
                                  enctype="multipart/form-data">
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
                                                   value="{{ $setting->address }}"
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
                                                   value="{{ $setting->address_number }}"
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
                                                   value="{{ $setting->first_phone }}"
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
                                                   value="{{ $setting->second_phone }}"
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
                                                   value="{{ $setting->facebook_url }}"
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
                                                   value="{{ $setting->email }}"
                                                   class="form-control">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>О компании</label>
                                            <textarea name="about" class="form-control">{{ $setting->about }}</textarea>
                                            @error('about')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Цель</label>
                                            <textarea name="target" class="form-control">{{ $setting->target }}</textarea>
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
                                                   value="Изменять">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
