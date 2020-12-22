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
            <form action = "{{route('admin.header.menu.update', $itemMenu->id)}}" method = "POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Название</label>
                    <input class="form-control" name = "name" type = "text" value = "{{$itemMenu->name}}">
                </div>  
                <div class="form-group">
                    <label for="url">Урл</label>
                    <input class="form-control" name = "url" type = "text" value = "{{$itemMenu->url}}">
                </div>
                <div class="form-group">
                    <label for="sort">Значение сортировки</label>
                    <input class="form-control" name = "sort" type = "text" value = "{{$itemMenu->sort}}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
            <div class = "button-delete">
                <form action = "{{route('admin.header.menu.destroy', $itemMenu->id)}}" method = "POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">Удалить</button>
                </form>
            </div>
        </div>
        </div>
@endsection