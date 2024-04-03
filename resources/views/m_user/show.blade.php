@extends('m_user/template')

@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Show User</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-secondary" href="{{ route('m_user.index') }}" style="background-color: #0084ff; color: white;">Kembali</a>        
        </div>
    </div>
</div>

<div class="row">
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <strong>User ID</strong>
                <p class="text-muted">{{ $useri->user_id }}</p>
            </div>
            <div class="col-md-6">
                <strong>Level ID</strong>
                <p class="text-muted">{{ $useri->level_id }}</p>
            </div>
        </div>
  
        <hr>
  
        <div class="row">
            <div class="col-md-6">
                <strong>Username</strong>
                <p class="text-muted">{{ $useri->username }}</p>
            </div>
            <div class="col-md-6">
                <strong>Nama</strong>
                <p class="text-muted">{{ $useri->nama }}</p>
            </div>
        </div>
  
        <hr>
  
        <div class="row">
            <div class="col-md-12">
                <strong>Password</strong>
                <p class="text-muted">{{ $useri->password }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
