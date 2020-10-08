@extends('layouts.app')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Профиль пользователя {{$user->name}}</span>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="site-section bg-white">
        <div class="container">
            @include('common.errors')
            <form action = "{{route('user.update', $user->id)}}" method = "POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Логин пользователя</label>
                    <input class="form-control" name = "name" type = "text" value = "{{$user->name}}">
                </div>  
                <div class="form-group">     
                    <label for="description">Краткая информация о вас</label>
                    <textarea class="form-control"  name = "description">{{$user->description}}</textarea>
                </div>  
                <div class="form-group">     
                    <label for="img">Аватар</label>
                    <img class="form-control avatar-profile" src = "{{$user->img}}" />
                    <input class="form-control" name = "image" type="file">
                </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        </div>
  </div>
@endsection