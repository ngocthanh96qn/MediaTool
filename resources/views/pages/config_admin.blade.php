@extends('pages.layouts')
@section('content')
<div class="container text-center mt-5">
  <div class="row">
    <div class="col-xl-6">      
          <form action="{{ route('adminToken') }}" method="POST" >
            @csrf
            <div class="form-group">
              <label> Name </label>
              <input type="text" class="form-control" name="name" >
            </div>
            <div class="form-group">
              <label> access_token </label>
              <input type="text" class="form-control" name="access_token" >
            </div>
            <button type="submit" class="btn btn-warning">Lưu Token</button>
          </form>
    </div>
    <div class="col-xl-6">
     <form action="{{ route('adminWeb') }}" method="POST" >
      @csrf
      <div class="row">
        <div class="col-xl-12">
           <label for="inputState">Chọn Token</label>
            <select id="inputState" class="form-control" name="token_id">
              <option selected disabled >Chọn...</option>
              @foreach ($list_token as $element)
              <option  value="{{$element->id}}">{{$element->name}}</option>
              @endforeach
            </select>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-xl-6">

         <div class="form-group">
          <label> Id page  </label>
          <input type="text" class="form-control" name="id_page" placeholder="ex: 104651187547290" >
        </div>
        <div class="form-group">
          <label> Domain web liên kết  </label>
          <input type="text" class="form-control" name="domain" placeholder="ex: 24h.xaluanvn.net" >
        </div>
        <div class="form-group">
          <label> Id Ads  </label>
          <input type="text" class="form-control" name="id_ads" placeholder="ex: 0000_111" >
        </div>

      </div>
      <div class="col-xl-6">

       <div class="form-group">
        <label> Tên Page  </label>
        <input type="text" class="form-control" name="page_name" placeholder="ex: Đọc Tin Hay">
      </div>
      <div class="form-group">
        <label> Tên web  </label>
        <input type="text" class="form-control" name="web_name" placeholder="ex: 24h Xã Luận" >
      </div>
      <div class="form-group">
          <label> Id Analytics  </label>
          <input type="text" class="form-control" name="id_analytics" placeholder="UA-178506002-1" >
        </div>

    </div>
  </div>
  <button type="submit" class="btn btn-success">Cài Đặt Trang</button>
</form>
</div>


</div>
<div class="row mt-5">
  <div class="col-xl-12">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">TOKEN</th>
          <th scope="col">NAME</th>
          <th scope="col">CREATED_AT</th>
          <th scope="col">EDIT</th>
          <th scope="col">DELETE</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($list_token as $element)
        <tr>
          <td >
            <p class="d-inline-block text-truncate" style="max-width: 250px;">
              {{$element->access_token}}
            </p>
          </td>
          <td >
            <p class="d-inline-block text-truncate" style="max-width: 250px;">
              {{$element->name}}
            </p>
          </td>
          <td>{{$element->created_at}}</td>
          <td>
            <a href="#" class="pull-right">
            <button class="btn btn-primary btn-xs edit_token"  data-toggle="modal" data-target="#modal_edit_token" data-id ='{{$element->id}}' data-name ='{{$element->name}}' data-token ='{{$element->access_token}}' >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg>
          </button></a>
          </td>
          <td> <a href="#"><button class="btn btn-danger btn-xs delete_token" data-toggle="modal" data-target="#modal_delete_token" data-id ='{{$element->id}}'>Delete</button></a></td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>

<div class="row mt-5 ">
  <div class="col-xl-12">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Name Token</th>
          <th scope="col">ID Trang</th>
          <th scope="col">Tên Trang</th>
          <th scope="col">Domain web</th>
          <th scope="col">Tên Web</th>
          <th scope="col">Id Ads</th>
          <th scope="col">Id Analytics</th>
          <th scope="col">Edit</th>
          <th scope="col">Xóa</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($list_web as $key=>$element)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$mangNameToken[$element->id]}}</td>
          <td>{{$element->id_page}}</td>
          <td>{{$element->page_name}}</td>
          <td>{{$element->domain}}</td>
          <td>{{$element->web_name}}</td>
          <td>{{$element->id_ads}}</td>
          <td>{{$element->id_analytics}}</td>
          <td>
            <a href="#" class="pull-right">
            <button class="btn btn-primary btn-xs edit_web"  data-toggle="modal" data-target="#modal_edit_web" data-id ='{{$element->id}}' data-idpage ='{{$element->id_page}}' data-pagename ='{{$element->page_name}}' data-domain ='{{$element->domain}}' data-webname ='{{$element->web_name}}' data-idads ='{{$element->id_ads}}' data-idanalytics ='{{$element->id_analytics}}'  >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg>
          </button></a>
          </td>
          <td> <a href="#"><button class="btn btn-danger btn-xs delete_web" data-toggle="modal" data-target="#modal_delete_web" data-id ='{{$element->id}}'>Delete</button></a></td>
          {{-- <td><a  href="{{ route('deleteConfigWeb',$element->id) }}">Delete</a></td> --}}
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

<div class="modal fade" id="modal_delete_web" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xác Nhận</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form role="form" action="{{ route('deleteConfigWeb') }}" method="POST">
                  <!-- text input -->
           @csrf                          
           <p style="color: red; font-size: 45px; font-weight: bold;">Lưu ý!!</p><p style="font-size: 20px;" >Bạn mún xóa web này??</p>       
            <input type="hidden" id="delete_webid" name="webid" value="">             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
        <button type="submit" class="btn btn-primary"> Xóa </button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_delete_token" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xác Nhận</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form role="form" action="{{ route('deleteToken') }}" method="POST">
                  <!-- text input -->
           @csrf                          
           <p style="color: red; font-size: 45px; font-weight: bold;">Lưu ý!!</p><p style="font-size: 20px;" >Nếu xóa sẽ xóa tất cả các web sử dụng token này</p>       
            <input type="hidden" id="delete_tokenid" name="tokenid" value="">             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
        <button type="submit" class="btn btn-primary"> Xóa </button>
      </div>
    </form>
    </div>
  </div>
</div> 
<!-- Modal -->
<div class="modal fade" id="modal_edit_token" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Token</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                          <form role="form" action="{{ route('editToken') }}" method="POST">
                  <!-- text input -->
                  @csrf               
                  
                  <div class="form-group">
                    <label> Name </label>
                    <input type="text" class="form-control" id="edit_tokenName"   name="tokenName" value="">
                  </div>         
                  <div class="form-group">
                    <label> Token </label>
                    <input type="text" class="form-control" id="edit_accessToken" name="accessToken" value="">
                  </div>
                  <input type="hidden" id="edit_tokenId" name="token_id" value="">      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
        <button type="submit" class="btn btn-primary"> Save </button>
      </div>
      </form> 
    </div>
  </div>
</div> 

<div class="modal fade" id="modal_edit_web" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit web</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <form role="form" action="{{ route('editConfigWeb') }}" method="POST">
                  <!-- text input -->
                  @csrf               
                   <div class="form-group">
                    <label style="color:red" > Token </label>
                    <select id="inputState" class="form-control" name="token_id">
                      <option selected disabled > Chọn...</option>
                      @foreach ($list_token as $element)
                      <option  value="{{$element->id}}">{{$element->name}}</option>
                      @endforeach
                    </select>
                  </div>  

                  <div class="form-group">
                    <label> Id Page </label>
                    <input type="text" class="form-control" id="edit_idPage"   name="idPage" value="">
                  </div> 
                  <div class="form-group">
                    <label> Page Name </label>
                    <input type="text" class="form-control" id="edit_pageName" name="page_name" value="">
                  </div>       
                  <div class="form-group">
                    <label> Domain </label>
                    <input type="text" class="form-control" id="edit_domain" name="domain" value="">
                  </div>
                  <div class="form-group">
                    <label> Web Name </label>
                    <input type="text" class="form-control" id="edit_webName" name="webName" value="">
                  </div>
                  <div class="form-group">
                    <label> Id Ads </label>
                    <input type="text" class="form-control" id="edit_idAds" name="idAds" value="">
                  </div>
                  <div class="form-group">
                    <label> Id Analytics </label>
                    <input type="text" class="form-control" id="edit_idAnalytics" name="idAnalytics" value="">
                  </div>
                  <input type="hidden" id="edit_webid" name="web_id" value="">      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
        <button type="submit" class="btn btn-primary"> Save </button>
      </div>
      </form> 
    </div>
  </div>
</div> 
@if (session('errors'))
    <div class="alert alert-danger">
        {{ 'Lỗi: Chưa điền đủ thông tin' }}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(function(){
        $('.edit_token').click(function(){ 
        document.getElementById("edit_tokenName").value=$(this).data("name");
        document.getElementById("edit_accessToken").value=$(this).data("token");
        document.getElementById("edit_tokenId").value= $(this).data("id");
        });
        $('.delete_token').click(function(){
        document.getElementById("delete_tokenid").value=$(this).data("id");
        });
        $('.delete_web').click(function(){
        document.getElementById("delete_webid").value=$(this).data("id");
        });
        $('.edit_web').click(function(){ 
        document.getElementById("edit_idPage").value=$(this).data("idpage");
        document.getElementById("edit_pageName").value=$(this).data("pagename");
        document.getElementById("edit_domain").value=$(this).data("domain");
        document.getElementById("edit_webName").value= $(this).data("webname");
        document.getElementById("edit_idAds").value= $(this).data("idads");
        document.getElementById("edit_idAnalytics").value= $(this).data("idanalytics");
        document.getElementById("edit_webid").value= $(this).data("id");
        });

});
</script>
@endsection
{{-- @push('scripts')

@endpush --}}