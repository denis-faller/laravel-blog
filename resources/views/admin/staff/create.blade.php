@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>{{$title}}</span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section bg-white">
        <div class="container">
            @include('common.errors')
            <form action = "{{route('admin.staff.store')}}" method = "POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Фио сотрудника</label>
                    <input class="form-control" name = "name" type = "text">
                </div>
                <div class="form-group">     
                    <label for="description">Описание</label>
                     <input class="form-control" name = "description" type = "text">
                </div>
                <div class="form-group">     
                    <label for="img">Фото сотрудника</label>
                    <input class="form-control" name = "img" type="file">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input class="form-control" name = "facebook" type = "text">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input class="form-control" name = "instagram" type = "text">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input class="form-control" name = "twitter" type = "text">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        </div>
  </div>
@endsection