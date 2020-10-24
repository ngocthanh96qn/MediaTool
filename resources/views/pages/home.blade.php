@extends('pages.layouts')
@section('content')
<div class="container mt-5">
  <div class="row" style="background: #2EFEC8; border-radius:5px">
    <div class="col-xl-5 offset-xl-4 mt-5 mb-5">
      <form action="{{route('render')}}" method="POST" >
        @csrf
        <h3 class="text-center" style="color: red; font-weight: 900"> CHỌN WEB </h3>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="select_web" id="exampleRadios1" value="1" checked>
          <label  style="color: #3B0B0B; font-size: 15px; font-weight:5px" class="form-check-label" for="exampleRadios1">
            WEB: 24h.xaluanvn.net - PAGE: Đọc tin nhanh
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="select_web" id="exampleRadios2" value="2" >
          <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios2">
            WEB: 24h.xaluanvn.net - PAGE: Đọc tin nhanh
          </label>
        </div>
        <div class="form-group text-center mt-3">
          <label style="color: red; font-size: 20px; font-weight: 900"> NHẬP ID BÀI VIẾT </label>
          <input type="text" class="form-control" name="post_id" >
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary " style="background: #FFBF00; color:#8A0808"> Đăng IA </button>
        </div>

        @if (isset($mes))
        <div class="text-center mt-5" style="color:red; font-size: 20px">
          <p>{{$mes}}</p>
        </div>
        @endif

      </form>
      @if (isset($notice))
      <div class="alert alert-danger mt-5">
        <strong>Chú Ý !! </strong> {{$notice}}
      </div>
      @endif
    </div>
    <div class="col-xl-2 offset-xl-1  mt-5 mb-5">
            <a href="{{ route('fixDraft') }}" class="btn btn-primary" style="padding: 15px;">Fix lỗi  
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-globe" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"/>
</svg></a>
        </div>
  </div>
  <div class="row">
    <div class="col-xl-12  mt-5 mb-5">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Web</th>
            <th scope="col">Tiêu đề</th>
            <th scope="col">Trạng thái IA</th>
            <th scope="col">Update IA</th>
            <th scope="col">Update bài viết</th>
            <th scope="col">Xóa</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>3456</td>
            <td>xemnhanh.info</td>
            <td ><p class="d-inline-block text-truncate" style="max-width: 150px;">nội dung xxxxxxxxxxxxxxxxxxxxxxx aaaaaaaaaaaaaaaaaaaa</p></td>
            <td> Đang xử lí </td>
            <td><a href="#" class="btn btn-success">Update</a></td>
            <td><a href="#" class="btn btn-primary">Update</a></td>
            <td><a href="#" class="btn btn-danger">Delete</a></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection