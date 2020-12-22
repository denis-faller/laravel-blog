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
            <form action = "{{route('admin.staff.update', $staff->id)}}" method = "POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Фио сотрудника</label>
                    <input class="form-control" name = "name" type = "text" value = "{{$staff->name}}">
                </div>  
                <div class="form-group">
                    <label for="description">Описание</label>
                    <input class="form-control" name = "description" type = "text" value = "{{$staff->description}}">
                </div>
                <div class="form-group">     
                    <label for="img">Фото сотрудника</label>
                    <img class="form-control avatar-profile" src = "{{$staff->img}}" />
                    <input class="form-control" name = "img" type="file">
                </div>
                <div class="form-group">
                    <label for="facebook">Описание</label>
                    <input class="form-control" name = "facebook" type = "text" value = "{{$staff->facebook}}">
                </div>
                <div class="form-group">
                    <label for="instagram">Описание</label>
                    <input class="form-control" name = "instagram" type = "text" value = "{{$staff->instagram}}">
                </div>
                <div class="form-group">
                    <label for="twitter">Описание</label>
                    <input class="form-control" name = "twitter" type = "text" value = "{{$staff->twitter}}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
                <div class = "button-delete">
                    <form action = "{{route('admin.staff.destroy', $staff->id)}}" method = "POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </form>
                </div>
        </div>
    </div>
@endsection