@extends('layouts.app')

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
            <form action = "{{route('users.store')}}" method = "POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(in_array($roleAdminID, $currentUserRolesIDs))
                <div class="form-group">
                    <label for="name">Роли пользователя</label>
                    <select class="form-control"  name="roles[]" size="3" multiple>
                        @foreach($roles as $role)
                        <option  value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                   </select>
                </div>
                @endif
                <div class="form-group">
                    <label for="name">Логин пользователя</label>
                    <input class="form-control" name = "name" type = "text">
                </div>
                <div class="form-group">     
                    <label for="description">Краткая информация о вас</label>
                    <textarea class="form-control"  name = "description"></textarea>
                </div>
                <div class="form-group">
                    <label for="email">Email пользователя</label>
                    <input class="form-control" name = "email" type = "email">
                </div>
                <div class="form-group">
                    <label for="password">Пароль пользователя</label>
                    <input class="form-control" name = "password" type = "password">
                </div>
                <div class="form-group">     
                    <label for="img">Аватар</label>
                    <input class="form-control" name = "image" type="file">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        </div>
  </div>
@endsection