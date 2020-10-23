@extends('pages.layouts')
@section('content')
<div class="container text-center mt-5">
    <div class="row">
        <div class="col-xl-2 offset-xl-5">
        <form action="{{route('render')}}" method="POST" >
            @csrf
                <div class="form-group">
                  <label> access_token </label>
                  <input type="text" class="form-control" name="token" >
                </div>
                <div class="form-group">
                    <label> id page  </label>
                    <input type="text" class="form-control" name="id_page" >
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
    
</div>
@endsection