@extends('admin.admin_master')

@section('admin')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Услуги</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главный</a></li>
          <li class="breadcrumb-item active">Услуги</li>
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
          <div class="card-header d-flex justify-content-end">
            <a href="{{ route('service.add') }}" class="btn btn-primary float-right">Добавить услуга</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Картина</th>
                <th>Имя</th>
                <th>Текст</th>
                <th>Управление</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($services as $item)
                  <tr>
                    <td width="1%">{{ $item->id }}</td>
                    <td width="15%">
                      <img
                      src="{{ asset($item->image) }}"
                      style="width: 90px; height: 60px;">
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{!! Str::limit(strip_tags($item->content), 50) !!}</td>
                    <td width="12%">
                      <a href="{{ route('service.edit', $item->id) }}" class="btn btn-info" title="Изменять"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('service.delete', $item->id) }}" class="btn btn-danger" title="Выключать" id="delete"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

