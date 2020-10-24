@extends('pages.layouts')
@section('content')
<div class="container text-center mt-5">
    <div class="row">
        <div class="col-xl-4 offset-xl-1">
        <form action="{{ route('adminToken') }}" method="POST" >
            @csrf
                <div class="form-group">
                  <label> access_token </label>
                  <input type="text" class="form-control" name="access_token" >
                </div>
                <button type="submit" class="btn btn-warning">Thiết lập Token</button>
        </form>
       
        </div>
        <div class="col-xl-4 offset-xl-2">
           <form action="{{ route('adminWeb') }}" method="POST" >
            @csrf
                <div class="form-group">
                    <label> Id page  </label>
                    <input type="text" class="form-control" name="id_page" >
                </div>
                <div class="form-group">
                    <label> Tên Page  </label>
                    <input type="text" class="form-control" name="page_name" >
                </div>
                 <div class="form-group">
                    <label> Domain web liên kết  </label>
                    <input type="text" class="form-control" name="domain" >
                </div>
                 <div class="form-group">
                    <label> Tên web  </label>
                    <input type="text" class="form-control" name="web_name" >
                </div>
                <button type="submit" class="btn btn-success">Cài Đặt Trang</button>
        </form>
        </div>
        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    </div>
    
</div>
@endsection
