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


</div>
<div class="row mt-5 ">
 <div class="col-xl-4 offset-xl-1">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Token</th>
        <th scope="col">Ngày tạo</th>
      </tr>
    </thead>
    <tbody>
      
        @foreach ($list_token as $element)
          <tr>
            <td>{{$element->access_token}}</td>
            <td>{{$element->created_at}}</td>
         </tr>
        @endforeach
        
    </tbody>
  </table>

</div>

<div class="col-xl-6 offset-xl-1">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID Trang</th>
        <th scope="col">tên Trang</th>
        <th scope="col">Domain web</th>
        <th scope="col">Tên Web</th>
        <th scope="col">Xóa</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($list_web as $element)
          <tr>
            <td>{{$element->id_page}}</td>
            <td>{{$element->page_name}}</td>
            <td>{{$element->domain}}</td>
            <td>{{$element->web_name}}</td>
            <td><a href="{{ route('deleteConfigWeb',$element->id) }}">Delete</a></td>
         </tr>
        @endforeach
    </tbody>
  </table>

</div>
</div>

</div>
@endsection
