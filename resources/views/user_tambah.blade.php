{{-- <!DOCTYPE html>
<html>
    <head>
        <title>Tambah Data User</title>
    </head>
    <body>
        <h1>Form Tambah Data User</h1>
        <form method="post" action="{{route('user.tambah_simpan')}}">
            {{csrf_field()}}

            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan Username">
            <br>
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Masukkan Nama">
            <br>
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan Password">
            <br>
            <label>Level ID</label>
            <input type="number" name="level_id" placeholder="Masukkan ID Level">
            <br><br>
            <input type="submit" class="btn btn-success" value="Simpan">
        </form>
    </body>
</html> --}}

@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Add Data')
@section('content')
<!-- general form elements disabled -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form Tambah Data User</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
     <form method="post" action="tambah_simpan">
            {{ csrf_field() }}
        <div class="row">
          <div class="col-sm-12">
            <!-- text input -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <div class="form-group">
                <label for="level_id">Level ID</label>
                <input type="number" class="form-control" id="level_id" name="level_id" placeholder="Masukkan ID Level" required>
            </div>
            <div class="card-footer">
                <a href="../user" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Add Data</button>
          </div>
        </div>
       
      </form>
    </div>
    <!-- /.card-body -->
  </div>
@stop