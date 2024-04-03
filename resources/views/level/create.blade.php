@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Add Level')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Form Tambah Level</h3>
            </div>

            <form method="post" action="/store">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeLevel">Kode Level</label>
                        <input id="level_kode"
                            type="text" 
                            name="level_kode"
                            class="@error('level_kode') is-invalid @enderror"  placeholder="Masukkan Kode Level">

                            @error('level_kode')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="namaLevel">Nama Level</label>
                        <input id="level_nama"
                            type="text" 
                            name="level_nama"
                            class="@error('level_nama') is-invalid @enderror"  placeholder="Masukkan Nama Level">

                            @error('level_nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>  
    </div>
@endsection